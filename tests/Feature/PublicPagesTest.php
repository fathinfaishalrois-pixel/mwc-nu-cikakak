<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class PublicPagesTest extends TestCase
{
 use RefreshDatabase;
 public function test_public_pages_are_reachable(): void
 {
  $this->seed();
  foreach(['/','/tentang','/kepengurusan','/berita','/kegiatan','/galeri','/kontak'] as $uri) $this->get($uri)->assertSuccessful();
 }
 public function test_published_detail_pages_are_reachable(): void
 {
  $this->seed();
  $this->get('/berita/musyawarah-program-kerja-mwc-nu-cikakak')->assertSuccessful();
  $this->get('/kegiatan/kajian-ahad-pagi-dan-silaturahmi-warga')->assertSuccessful();
 }
}
