<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Kegiatan; use Illuminate\Http\Request; use Illuminate\Support\Facades\Storage; use Illuminate\Support\Str;
class KegiatanController extends Controller
{
 public function index(){return view('admin.kegiatan.index',['items'=>Kegiatan::latest('tanggal')->paginate(15)]);} public function create(){return view('admin.kegiatan.form',['item'=>new Kegiatan(),'action'=>route('admin.kegiatan.store'),'method'=>'POST']);}
 public function store(Request $r){$d=$this->validated($r);$d['slug']=$this->slug($d['nama']);$d['foto']=$this->upload($r);Kegiatan::create($d);return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan berhasil disimpan.');}
 public function edit(Kegiatan $kegiatan){return view('admin.kegiatan.form',['item'=>$kegiatan,'action'=>route('admin.kegiatan.update',$kegiatan),'method'=>'PUT']);}
 public function update(Request $r,Kegiatan $kegiatan){$d=$this->validated($r);$d['slug']=$this->slug($d['nama'],$kegiatan->id);if($r->hasFile('foto')){$this->delete($kegiatan->foto);$d['foto']=$this->upload($r);} $kegiatan->update($d);return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan berhasil diperbarui.');}
 public function destroy(Kegiatan $kegiatan){$this->delete($kegiatan->foto);$kegiatan->delete();return back()->with('success','Kegiatan berhasil dihapus.');}
 private function validated(Request $r):array{return $r->validate(['nama'=>'required|string|max:220','foto'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:3072','tanggal'=>'required|date','waktu'=>'nullable|string|max:80','lokasi'=>'nullable|string|max:220','ringkasan'=>'nullable|string|max:600','deskripsi'=>'nullable|string|max:30000','status'=>'required|in:draft,published']);}
 private function slug(string $title,?int $ignore=null):string{$b=Str::slug($title)?:'kegiatan';$s=$b;$i=2;while(Kegiatan::where('slug',$s)->when($ignore,fn($q)=>$q->where('id','!=',$ignore))->exists())$s=$b.'-'.$i++;return $s;}
 private function upload(Request $r):?string{return $r->hasFile('foto')?$r->file('foto')->store('kegiatan','public'):null;} private function delete(?string $p):void{if($p&&!Str::startsWith($p,'assets/'))Storage::disk('public')->delete($p);}
}
