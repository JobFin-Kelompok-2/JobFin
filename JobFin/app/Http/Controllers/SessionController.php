<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    function index(){
        return view("sesi/index");
    }

    function login(Request $request){
        $request->validate([
            "email"=>"required",
            "password"=>"required"
        ],[
            "email.required"=>"isi email",
            "password.required"=>"isi password"
        ]);

        if ($request->email === 'admin@gmail.com') {
            $admin = DB::select('SELECT * FROM admins WHERE email = ?', [$request->email]);
            
            if (!empty($admin) && Hash::check($request->password, $admin[0]->password)) {
                session(['is_admin' => true]);
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai admin!');
            }
        }

        if ($request->email === 'pengelola@gmail.com') {
            $pengelola = DB::select('SELECT * FROM pengelola WHERE email = ?', [$request->email]);
            
            if (!empty($pengelola) && Hash::check($request->password, $pengelola[0]->password)) {
                return redirect()->route('pengelola.home')->with('success', 'Login berhasil sebagai pengelola!');
            }
        }

        // Jika bukan admin atau pengelola, cek login user biasa
        $user = DB::select('SELECT * FROM users WHERE email = ?', [$request->email]);
        
        if (!empty($user) && Hash::check($request->password, $user[0]->password)) {
            Auth::loginUsingId($user[0]->id);
            return redirect()->route("page.home")->with("success", "Login berhasil!");
        } else {
            return redirect()->route('login')->with('error', 'Login gagal! Email atau password salah.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('is_admin');
        
        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
