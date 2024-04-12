<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfileUser()
    {
        // Mendapatkan informasi akun yang sedang login
        $user = Auth::user();
        
        // Memeriksa apakah pengguna sudah login
        if ($user) {
            // Jika pengguna sudah login, tampilkan informasinya
            return view('profile', ['user' => $user]);
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->route('login');
        }
    }

    public function showProfileAdmin()
    {
        // Mendapatkan informasi akun yang sedang login
        $user = Auth::user();
        
        // Memeriksa apakah pengguna sudah login
        if ($user) {
            // Jika pengguna sudah login, tampilkan informasinya
            return view('admin.profileadmin', ['user' => $user]);
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->route('login');
        }
    }
}