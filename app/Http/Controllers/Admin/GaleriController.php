<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\Galeri; use Illuminate\Http\Request; use Illuminate\Support\Facades\Storage; use Illuminate\Support\Str;
class GaleriController extends Controller
{
 public function index(){return view('admin.galeri.index',['items'=>Galeri::latest('tanggal')->paginate(18)]);} public function create(){return view('admin.galeri.form',['item'=>new Galeri(),'action'=>route('admin.galeri.store'),'method'=>'POST']);}
 public function store(Request $r){$d=$this->validated($r);$d['status']=$r->boolean('status');$d['gambar']=$r->file('gambar')->store('galeri','public');Galeri::create($d);return redirect()->route('admin.galeri.index')->with('success','Galeri berhasil disimpan.');}
 public function edit(Galeri $galeri){return view('admin.galeri.form',['item'=>$galeri,'action'=>route('admin.galeri.update',$galeri),'method'=>'PUT']);}
 public function update(Request $r,Galeri $galeri){$d=$this->validated($r,false);$d['status']=$r->boolean('status');if($r->hasFile('gambar')){$this->delete($galeri->gambar);$d['gambar']=$r->file('gambar')->store('galeri','public');}$galeri->update($d);return redirect()->route('admin.galeri.index')->with('success','Galeri berhasil diperbarui.');}
 public function destroy(Galeri $galeri){$this->delete($galeri->gambar);$galeri->delete();return back()->with('success','Galeri berhasil dihapus.');}
 private function validated(Request $r,bool $required=true):array{return $r->validate(['judul'=>'required|string|max:220','gambar'=>[$required?'required':'nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],'deskripsi'=>'nullable|string|max:1000','tanggal'=>'nullable|date','status'=>'nullable|boolean']);}
 private function delete(?string $p):void{if($p&&!Str::startsWith($p,'assets/'))Storage::disk('public')->delete($p);}
}
