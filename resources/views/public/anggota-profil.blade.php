@extends('layouts.app')

@section('title', 'Profil Anggota — MWC NU Cikakak')

@push('head')
<style>
.profile-page{max-width:1000px;margin:auto;padding:58px 20px 90px}.profile-heading{margin-bottom:28px}.profile-heading p{font-size:11px;text-transform:uppercase;letter-spacing:.18em;color:#087443}.profile-heading h1{font-size:clamp(30px,4vw,44px);font-weight:800;margin-top:10px}.profile-layout{display:grid;grid-template-columns:minmax(0,1fr) minmax(300px,.9fr);gap:28px;align-items:start}.profile-panel{border:1px solid #dce5dc;background:#fff;border-radius:18px;padding:24px}.profile-panel h2{font-size:18px;font-weight:800;margin:0 0 18px}.profile-data{display:grid;grid-template-columns:1fr 1fr;gap:16px}.profile-data div{border-bottom:1px solid #e7ece7;padding-bottom:12px;min-width:0}.profile-data dt{font-size:10px;letter-spacing:.1em;text-transform:uppercase;color:#718074;margin-bottom:5px}.profile-data dd{font-size:14px;font-weight:650;overflow-wrap:anywhere;margin:0}.profile-card{position:relative;aspect-ratio:1.586/1;border-radius:22px;overflow:hidden;padding:22px;color:white;background:radial-gradient(ellipse at 80% 10%,#d8ffb36b,transparent 34%),radial-gradient(ellipse at 15% 100%,#6cf3bf42,transparent 40%),linear-gradient(135deg,#073e2a,#087443 48%,#123d2e);box-shadow:0 22px 48px #052b1c38;transform-style:preserve-3d;transition:transform .12s}.profile-card:after{content:"";position:absolute;inset:0;border:1px solid #ffffff50;border-radius:inherit;pointer-events:none}.profile-card-head{display:flex;gap:10px;align-items:center}.profile-emblem{width:37px;height:37px;border:1px solid #d7f7bb;border-radius:50%;display:grid;place-items:center;color:#e9ffcc;font-weight:900;font-size:12px}.profile-org{font-size:11px;font-weight:800;letter-spacing:.09em}.profile-org small{display:block;font-size:8px;letter-spacing:.16em;opacity:.75;margin-top:3px}.profile-chip{width:39px;height:29px;border-radius:7px;background:linear-gradient(135deg,#f9e7a0,#a9b68b,#e7d18a);margin-top:22px}.profile-name{font-size:clamp(17px,2.3vw,24px);font-weight:800;margin-top:13px;overflow-wrap:anywhere}.profile-code{font-size:11px;letter-spacing:.12em;font-weight:800;margin-top:7px}.profile-foot{position:absolute;left:22px;right:22px;bottom:17px;display:flex;justify-content:space-between;gap:10px;font-size:8px;letter-spacing:.12em;text-transform:uppercase;opacity:.85}.profile-actions{display:flex;gap:9px;margin-top:16px}.profile-actions button,.profile-actions a{flex:1;text-align:center;padding:12px;border:1px solid #d6e2d7;border-radius:10px;background:white;color:#1b3b28;font-size:12px;font-weight:700;cursor:pointer}.profile-status{padding:13px 15px;border-radius:11px;font-size:12px;line-height:1.6;margin-bottom:18px;background:#fff6df;color:#73520b}.profile-status.active{background:#e9f8ed;color:#176336}.profile-small{font-size:12px;color:#647166;line-height:1.7;margin-top:16px}.profile-card-wrap{perspective:1200px;position:relative;touch-action:pan-y;cursor:grab;transform-style:preserve-3d;transition:transform .08s linear}.profile-card-wrap:active{cursor:grabbing}.profile-card{transition:transform .7s cubic-bezier(.2,.75,.2,1);transform-style:preserve-3d}.profile-card.is-flipped{transform:rotateY(180deg)!important}.profile-face{position:absolute;inset:0;padding:inherit;backface-visibility:hidden;-webkit-backface-visibility:hidden}.profile-face-front{z-index:1}.profile-face-back{transform:rotateY(180deg);background:radial-gradient(ellipse at 90% 0%,#d8ffb34a,transparent 35%),linear-gradient(135deg,#123d2e,#073e2a);display:flex;flex-direction:column;justify-content:space-between}.profile-face-back h3{font-size:clamp(14px,2vw,21px);font-weight:800;letter-spacing:.08em}.profile-face-back p{font-size:11px;line-height:1.6;max-width:90%}.profile-face-back .back-code{font-size:clamp(12px,1.8vw,17px);font-weight:800;letter-spacing:.14em;overflow-wrap:anywhere}.profile-face-back .back-footer{font-size:8px;letter-spacing:.12em;text-transform:uppercase;opacity:.8}.profile-photo{width:58px;height:58px;border-radius:50%;object-fit:cover;border:2px solid #e6f8d5;box-shadow:0 2px 12px #001d1266}.profile-photo-placeholder{width:58px;height:58px;border-radius:50%;display:grid;place-items:center;background:#d8f7bd;color:#073e2a;font-weight:900;font-size:20px;border:2px solid #e6f8d5}.profile-back-layout{display:flex;align-items:center;gap:12px}.profile-qr{background:#fff;padding:6px;border-radius:8px;min-width:88px;min-height:88px;display:grid;place-items:center}.profile-qr canvas,.profile-qr img{max-width:88px;max-height:88px}.profile-qr-help{font-size:9px!important;overflow-wrap:anywhere}
@media(max-width:760px){.profile-layout{grid-template-columns:1fr}.profile-card{padding:17px}.profile-chip{margin-top:15px}.profile-foot{left:17px;right:17px;bottom:13px}}@media(max-width:420px){.profile-panel{padding:17px}.profile-card{border-radius:17px;padding:14px}.profile-emblem{width:30px;height:30px}.profile-org{font-size:9px}.profile-chip{width:31px;height:23px;margin-top:11px}.profile-name{font-size:16px;margin-top:8px}.profile-foot{left:14px;right:14px;bottom:10px;font-size:6px}}
</style>
@endpush

@section('content')
<section class="profile-page">
    <div class="profile-heading"><p>Keanggotaan · MWC NU Cikakak</p><h1>Profil anggota</h1><p style="font-size:14px;letter-spacing:0;text-transform:none;color:#667268;margin-top:10px">Simpan tautan profil ini agar dapat dibuka kembali. Tautan bersifat pribadi.</p></div>
    @if(session('success'))<div class="profile-status">{{ session('success') }}</div>@endif
    <div class="profile-layout">
        <section class="profile-panel">
            <h2>Data pendaftaran</h2>
            <form action="{{ route('anggota.profil.foto', ['token' => $token]) }}" method="POST" enctype="multipart/form-data" class="profile-photo-form" style="margin-bottom:22px;padding:16px;border:1px solid #dce8dc;border-radius:14px;background:#f7fbf7">
                @csrf
                <label for="foto-anggota" style="display:block;font-weight:800;font-size:14px;margin-bottom:8px">Foto profil kartu</label>
                <div style="display:flex;gap:14px;align-items:center;flex-wrap:wrap">
                    @if($warga->foto)
                        <img id="foto-preview" src="{{ \Illuminate\Support\Facades\Storage::url($warga->foto) }}" alt="Pratinjau foto profil" style="width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid #c8e4ca">
                    @else
                        <div id="foto-preview-placeholder" style="width:72px;height:72px;border-radius:50%;display:grid;place-items:center;background:#d8f7bd;color:#073e2a;font-weight:900;font-size:24px">{{ mb_strtoupper(mb_substr($warga->nama, 0, 1)) }}</div>
                        <img id="foto-preview" src="" alt="Pratinjau foto profil" style="display:none;width:72px;height:72px;border-radius:50%;object-fit:cover;border:2px solid #c8e4ca">
                    @endif
                    <div style="flex:1;min-width:180px">
                        <input id="foto-anggota" name="foto" type="file" accept="image/jpeg,image/png,image/webp" required style="display:block;width:100%;font-size:13px">
                        <p style="font-size:12px;color:#667268;margin:7px 0 0">Pilih dari galeri atau kamera HP. JPG, PNG, WEBP; maksimal 2 MB.</p>
                    </div>
                </div>
                @error('foto')<p role="alert" style="color:#b42318;font-size:13px;margin:8px 0 0">{{ $message }}</p>@enderror
                <button type="submit" style="margin-top:13px;border:0;border-radius:9px;background:#087443;color:white;font-weight:800;padding:11px 15px;cursor:pointer">Simpan / Ganti Foto</button>
            </form>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('foto-anggota');
                const preview = document.getElementById('foto-preview');
                const placeholder = document.getElementById('foto-preview-placeholder');
                if (!input || !preview) return;
                input.addEventListener('change', function () {
                    const file = input.files && input.files[0];
                    if (!file) return;
                    if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type) || file.size > 2 * 1024 * 1024) {
                        alert('Pilih foto JPG, PNG, atau WEBP dengan ukuran maksimal 2 MB.');
                        input.value = '';
                        return;
                    }
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                });
            });
            </script>
            <div class="profile-status {{ $warga->status === 'aktif' ? 'active' : '' }}">{{ ($warga->verification_status ?? 'approved') === 'approved' && $warga->status === 'aktif' ? 'Status anggota: AKTIF DAN TERVERIFIKASI' : ((($warga->verification_status ?? 'pending') === 'rejected') ? 'Pendaftaran ditolak: '.($warga->rejection_reason ?: 'Silakan hubungi pengurus untuk informasi lebih lanjut.') : 'Status: MENUNGGU VERIFIKASI. Kartu belum resmi sampai diperiksa pengurus.') }}</div>
            <dl class="profile-data">
                <div><dt>Nama lengkap</dt><dd>{{ $warga->nama }}</dd></div>
                <div><dt>Foto profil</dt><dd>@if($warga->foto)<a href="{{ \Illuminate\Support\Facades\Storage::url($warga->foto) }}" target="_blank" rel="noopener">Lihat foto</a>@else Belum diunggah @endif</dd></div>
                <div><dt>Nomor induk / kode kartu</dt><dd>{{ $warga->card_code ?? 'Belum diterbitkan' }}</dd></div>
                <div><dt>NIK</dt><dd>{{ $warga->nik ? '••••••••••••'.substr($warga->nik, -4) : 'Belum diisi' }}</dd></div>
                <div><dt>Jenis kelamin</dt><dd>{{ $warga->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd></div>
                <div><dt>Nomor HP</dt><dd>{{ $warga->no_hp ?: '—' }}</dd></div>
                <div><dt>Pekerjaan</dt><dd>{{ $warga->pekerjaan ?: '—' }}</dd></div>
                <div><dt>Alamat</dt><dd>{{ $warga->alamat ?: '—' }}</dd></div>
                <div><dt>Dusun / Desa</dt><dd>{{ $warga->dusun ?: '—' }} / {{ $warga->desa ?: '—' }}</dd></div>
            </dl>
            <p class="profile-small">Jangan bagikan tautan profil ini sembarangan. Data identitas hanya ditampilkan di halaman privat ini, dan NIK disamarkan.</p>
        </section>
        <section class="profile-panel">
            <h2>Kartu anggota digital</h2>
            <div class="profile-card-wrap">
                <div class="profile-card" id="member-profile-card">
                    <div class="profile-face profile-face-front">
                        <div class="profile-card-head">@if($warga->foto)<img class="profile-photo" src="{{ \Illuminate\Support\Facades\Storage::url($warga->foto) }}" alt="Foto {{ $warga->nama }}">@else<div class="profile-photo-placeholder">{{ mb_strtoupper(mb_substr($warga->nama, 0, 1)) }}</div>@endif<div><div class="profile-org">MWC NU CIKAKAK<small>KARTU ANGGOTA DIGITAL</small></div></div></div>
                        <div class="profile-chip"></div>
                        <div class="profile-name">{{ $warga->nama }}</div>
                        <div class="profile-code">{{ $warga->card_code }}</div>
                        <div class="profile-foot"><span>Khidmah · Jam’iyah · Kemanfaatan</span><strong>{{ ($warga->verification_status ?? 'approved') === 'approved' && $warga->status === 'aktif' ? 'ANGGOTA AKTIF' : ((($warga->verification_status ?? 'pending') === 'rejected') ? 'PENDAFTARAN DITOLAK' : 'MENUNGGU VERIFIKASI') }}</strong></div>
                    </div>
                    <div class="profile-face profile-face-back">
                        <div><h3>IDENTITAS WARGA NU</h3><p>Kartu anggota digital MWC NU Cikakak. Status keanggotaan mengikuti verifikasi pengurus.</p></div>
                        <div class="profile-back-layout"><div id="member-qr" class="profile-qr" aria-label="QR profil anggota"></div><div><div class="back-code">{{ $warga->card_code }}</div><p>NIK: ••••••••••••{{ substr($warga->nik, -4) }}</p><p>{{ $warga->desa }} · Cikakak</p><p class="profile-qr-help">Pindai QR untuk membuka profil ini. Jangan bagikan tautan profil sembarangan.</p></div></div>
                        <div class="back-footer">Khidmah · Jam’iyah · Kemanfaatan</div>
                    </div>
                </div>
            </div>
            <div class="profile-actions"><button type="button" id="profile-tilt">Efek 3D: aktif</button><button type="button" id="profile-flip">Balik kartu</button><button type="button" id="profile-download">Unduh kartu PNG</button></div>
            <p class="profile-small">Kode kartu: <strong>{{ $warga->card_code }}</strong>. Kartu ini adalah bukti pendaftaran digital, bukan pengganti identitas resmi. Gunakan hanya setelah status diverifikasi pengurus.</p>
        </section>
    </div>
</section>
@endsection

@push('scripts')
<script>
(()=>{const qrTarget=document.getElementById('member-qr');if(qrTarget){const qrUrl=@json(url()->current());const script=document.createElement('script');script.src='https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js';script.onload=()=>{if(window.QRCode) new QRCode(qrTarget,{text:qrUrl,width:88,height:88,colorDark:'#123d2e',colorLight:'#ffffff',correctLevel:QRCode.CorrectLevel.M});};script.onerror=()=>{qrTarget.textContent='QR tidak tersedia';};document.head.appendChild(script);}const card=document.getElementById('member-profile-card'),wrap=card?.parentElement,toggle=document.getElementById('profile-tilt'),flip=document.getElementById('profile-flip'),download=document.getElementById('profile-download');if(!card||!wrap||!toggle||!flip||!download)return;let enabled=true,dragging=false,didDrag=false,startX=0,startY=0,rotation=0,tiltX=0;flip.addEventListener('click',()=>card.classList.toggle('is-flipped'));wrap.addEventListener('pointerdown',e=>{if(e.button!==undefined&&e.button!==0)return;dragging=true;didDrag=false;startX=e.clientX;startY=e.clientY;wrap.setPointerCapture?.(e.pointerId)});wrap.addEventListener('pointermove',e=>{if(dragging){if(Math.abs(e.clientX-startX)>3||Math.abs(e.clientY-startY)>3)didDrag=true;rotation+=(e.clientX-startX)*0.9;tiltX=Math.max(-18,Math.min(18,tiltX+(startY-e.clientY)*0.45));startX=e.clientX;startY=e.clientY;wrap.style.transform=`rotateX(${tiltX}deg) rotateY(${rotation}deg)`;return}if(!enabled)return;const r=wrap.getBoundingClientRect(),x=(e.clientX-r.left)/r.width,y=(e.clientY-r.top)/r.height;wrap.style.transform=`rotateX(${(.5-y)*10}deg) rotateY(${rotation+(x-.5)*14}deg)`});const stop=()=>{dragging=false;setTimeout(()=>{didDrag=false},80)};wrap.addEventListener('click',e=>{if(didDrag){e.preventDefault();return}if(e.target.closest('button,a'))return;card.classList.toggle('is-flipped')});wrap.addEventListener('pointerup',stop);wrap.addEventListener('pointercancel',stop);wrap.addEventListener('pointerleave',()=>{if(!dragging&&enabled)wrap.style.transform=`rotateX(0deg) rotateY(${rotation}deg)`});toggle.addEventListener('click',()=>{enabled=!enabled;toggle.textContent='Efek 3D: '+(enabled?'aktif':'nonaktif');if(!enabled)wrap.style.transform=`rotateX(0deg) rotateY(${rotation}deg)`});
download.addEventListener('click',()=>{const canvas=document.createElement('canvas');canvas.width=1200;canvas.height=757;const c=canvas.getContext('2d'),g=c.createLinearGradient(0,0,1200,757);g.addColorStop(0,'#073e2a');g.addColorStop(.5,'#087443');g.addColorStop(1,'#123d2e');c.fillStyle=g;c.fillRect(0,0,1200,757);c.strokeStyle='#d8f7bd';c.lineWidth=3;c.strokeRect(22,22,1156,713);c.fillStyle='#e9ffcc';c.beginPath();c.arc(105,105,42,0,Math.PI*2);c.fill();c.fillStyle='#073e2a';c.font='bold 30px Arial';c.textAlign='center';c.fillText('NU',105,115);c.textAlign='left';c.fillStyle='#fff';c.font='bold 30px Arial';c.fillText('MWC NU CIKAKAK',170,95);c.font='20px Arial';c.fillText('KARTU ANGGOTA DIGITAL',170,132);c.fillStyle='#f2dca1';c.roundRect(72,205,115,80,12);c.fill();c.fillStyle='#fff';c.font='bold 42px Arial';c.fillText(@json($warga->nama).slice(0,32),72,385);c.font='bold 26px Arial';c.fillText(@json($warga->card_code),72,455);c.font='bold 20px Arial';c.fillText(@json(($warga->verification_status ?? 'approved') === 'approved' && $warga->status === 'aktif' ? 'ANGGOTA AKTIF' : 'MENUNGGU VERIFIKASI'),72,510);c.font='18px Arial';c.fillText('CIKAKAK · WANGON · BANYUMAS',72,680);c.font='15px Arial';c.fillText('NIK TIDAK DICETAK PADA KARTU',72,715);const a=document.createElement('a');a.download='kartu-anggota-{{ $warga->card_code }}.png';a.href=canvas.toDataURL('image/png');a.click()});})();
</script>
@endpush
