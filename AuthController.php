<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function proses_login(Request $request){
        // Validasi input
        $request->validate([
            'username' => 'required|exists:users',
            'password' => 'required',
        ], 
        [
            'username.required' => 'Username harus diisi',
            'username.exists' => 'Username belum didaftarkan',
            'password.required' => 'Password harus diisi',
        ]);

        $otentifikasi = $request->only('username','password');

            if (Auth::attempt($otentifikasi)) {
                    return redirect()->route('dashboard');
                } else {
                    return redirect('/')->with('eror','Masukkan username dan password yang benar')->withInput();
                }
            }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('/');
    }
}
    

