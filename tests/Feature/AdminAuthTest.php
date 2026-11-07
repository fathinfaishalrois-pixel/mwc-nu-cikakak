<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class AdminAuthTest extends TestCase
{
 use RefreshDatabase;
 public function test_admin_can_login(): void
 {
  $this->seed();
  $this->post('/admin/login',['email'=>'admin@mwc-nu-cikakak.test','password'=>'password'])->assertRedirect('/admin');
  $this->get('/admin')->assertSuccessful();
 }
 public function test_non_admin_cannot_access_admin(): void
 {
  $user=User::factory()->create(['is_admin'=>false]);
  $this->actingAs($user)->get('/admin')->assertRedirect('/admin/login');
 }
}
