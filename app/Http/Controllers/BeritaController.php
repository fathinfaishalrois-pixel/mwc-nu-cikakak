<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class BeritaController extends Controller
{
    public function index(){return view('admin.berita.index',['items'=>Berita::latest('tanggal')->paginate(15)]);}
    public function create(){return view('admin.berita.form',['item'=>new Berita(),'action'=>route('admin.berita.store'),'method'=>'POST']);}
    public function store(Request $r){$d=$this->validated($r);$d['slug']=$this->slug($d['judul']);$d['thumbnail']=$this->upload($r);Berita::create($d);return redirect()->route('admin.berita.index')->with('success','Berita berhasil disimpan.');}
    public function edit(Berita $berita){return view('admin.berita.form',['item'=>$berita,'action'=>route('admin.berita.update',$berita),'method'=>'PUT']);}
    public function update(Request $r,Berita $berita){$d=$this->validated($r);$d['slug']=$this->slug($d['judul'],$berita->id);if($r->hasFile('thumbnail')){$this->delete($berita->thumbnail);$d['thumbnail']=$this->upload($r);} $berita->update($d);return redirect()->route('admin.berita.index')->with('success','Berita berhasil diperbarui.');}
    public function destroy(Berita $berita){$this->delete($berita->thumbnail);$berita->delete();return back()->with('success','Berita berhasil dihapus.');}
    private function validated(Request $r):array{return $r->validate(['judul'=>'required|string|max:220','kategori'=>'required|string|max:100','thumbnail'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:3072','ringkasan'=>'nullable|string|max:600','isi'=>'required|string|max:30000','penulis'=>'nullable|string|max:120','tanggal'=>'required|date','status'=>'required|in:draft,published']);}
    private function slug(string $title,?int $ignore=null):string{$base=Str::slug($title)?:'berita';$s=$base;$i=2;while(Berita::where('slug',$s)->when($ignore,fn($q)=>$q->where('id','!=',$ignore))->exists())$s=$base.'-'.$i++;return $s;}
    private function upload(Request $r):?string{return $r->hasFile('thumbnail')?$r->file('thumbnail')->store('berita','public'):null;}
    private function delete(?string $p):void{if($p&&!Str::startsWith($p,'assets/'))Storage::disk('public')->delete($p);}
}
