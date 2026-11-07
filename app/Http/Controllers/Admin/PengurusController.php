<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class PengurusController extends Controller
{
    public function index() { return view('admin.pengurus.index', ['items'=>Pengurus::with('parent')->orderBy('urutan')->orderBy('nama')->paginate(15)]); }
    public function create() { return view('admin.pengurus.form', ['item'=>new Pengurus(), 'parents'=>Pengurus::orderBy('urutan')->orderBy('nama')->get(), 'action'=>route('admin.pengurus.store'), 'method'=>'POST']); }
    public function store(Request $request) { $data=$this->validated($request); $data['status']=$request->boolean('status'); $data['slug']=$this->uniqueSlug($data['nama']); $data['foto']=$this->upload($request,'foto','pengurus'); $item=Pengurus::create($data); return redirect()->route('admin.pengurus.index')->with('success','Data pengurus berhasil disimpan.'); }
    public function edit(Pengurus $penguru) { return view('admin.pengurus.form', ['item'=>$penguru, 'parents'=>Pengurus::where('id','!=',$penguru->id)->orderBy('urutan')->orderBy('nama')->get(), 'action'=>route('admin.pengurus.update',$penguru), 'method'=>'PUT']); }
    public function update(Request $request, Pengurus $penguru)
    {
        $data=$this->validated($request,$penguru); $data['status']=$request->boolean('status'); $parent=(int)($data['parent_id'] ?? 0);
        if ($parent && $penguru->isDescendantOf($parent)) return back()->withInput()->with('error','Atasan tidak valid karena akan membentuk struktur melingkar.');
        $data['slug']=$this->uniqueSlug($data['nama'],$penguru->id);
        if ($request->hasFile('foto')) { $this->deleteFile($penguru->foto); $data['foto']=$this->upload($request,'foto','pengurus'); }
        $penguru->update($data); return redirect()->route('admin.pengurus.index')->with('success','Data pengurus berhasil diperbarui.');
    }
    public function destroy(Pengurus $penguru)
    {
        $penguru->children()->update(['parent_id'=>$penguru->parent_id]); $this->deleteFile($penguru->foto); $penguru->delete();
        return back()->with('success','Data pengurus berhasil dihapus.');
    }
    private function validated(Request $request, ?Pengurus $item=null): array
    {
        $rules=['nama'=>'required|string|max:150','jabatan'=>'required|string|max:150','bidang'=>'nullable|string|max:150','foto'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048','periode'=>'nullable|string|max:50','parent_id'=>['nullable','integer','exists:pengurus,id'],'urutan'=>'nullable|integer|min:0|max:999','bio'=>'nullable|string|max:1000','deskripsi'=>'nullable|string|max:10000','pendidikan'=>'nullable|string|max:180','status'=>'nullable|boolean']; if($item) $rules['parent_id'][]=Rule::notIn([$item->id]); return $request->validate($rules);
    }
    private function uniqueSlug(string $name, ?int $ignore=null): string { $base=Str::slug($name) ?: 'pengurus'; $slug=$base; $i=2; while(Pengurus::where('slug',$slug)->when($ignore,fn($q)=>$q->where('id','!=',$ignore))->exists()) $slug=$base.'-'.$i++; return $slug; }
    private function upload(Request $request,string $field,string $dir): ?string { return $request->hasFile($field) ? $request->file($field)->store($dir,'public') : null; }
    private function deleteFile(?string $path): void { if($path && !Str::startsWith($path,'assets/')) Storage::disk('public')->delete($path); }
}
