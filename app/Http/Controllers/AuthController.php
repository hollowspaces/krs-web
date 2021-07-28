<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller {
    // menampilkan halaman login
    public function getLogin() {
        return view('auth.login');
    }

    // proses login dengan username dan password
    public function doLogin(Request $request) {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(auth()->attempt($credentials)) {
            return redirect('/');
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    // proses logout
    public function doLogout() {
        auth()->logout();

        return redirect('/login');
    }
}
