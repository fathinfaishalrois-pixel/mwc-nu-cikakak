<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showLogin() { return view('admin.auth.login'); }
    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => ['required','email'], 'password' => ['required','string']]);
        if (Auth::attempt([...$credentials, 'is_admin' => true], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang di panel admin.');
        }
        return back()->withInput($request->only('email','remember'))->with('error', 'Email atau password administrator tidak sesuai.');
    }
    public function logout(Request $request)
    {
        Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success','Anda telah keluar dari panel admin.');
    }
}
