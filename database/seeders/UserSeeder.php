<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
 public function run(): void { User::updateOrCreate(['email'=>'admin@mwc-nu-cikakak.test'],['name'=>'Administrator MWC NU Cikakak','password'=>'password','is_admin'=>true]); }
}
