<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function cek()
    {
        if(Auth::user()){
            dd(Auth::user());
        }else{
            dd('tidak ada user login');
        }
    }

    public function init()
    {
        if(Auth::user()){
            return response()->json([
                'isLogin' => true,
                'user' => Auth::user()
            ]);
        }else{
            return response()->json([
                'isLogin' => false,
                'user' => []
            ]);
        }
    }

    public function register()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|numeric|min:11',
            'pass' => 'required',
            'confirm' => 'required|same:pass'
        ]);
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'telepon' => request('telepon'),
            'role' => 2,
            'password' => Hash::make(request('pass'))
        ]);
        return response()->json([
            'message' => 'Akun telah berhasil didaftarkan'
        ]);
    }

    public function login()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $remember = request('remember') != null ? true : false;
        if (Auth::attempt(request()->only('email', 'password'), $remember )) {
            if(auth()->user()->role == 1){
                return response()->json(['message' => 'Selamat datang admin!', 'type' => 'success', 'role' => Auth::user()->role]);
            }else{
                return response()->json(['message' => 'Selamat datang! Silahkan berbelanja', 'type' => 'success', 'role' => Auth::user()->role]);
            }
        }else{
            return response()->json(['message' => 'Maaf! email atau kata sandi salah!', 'type' => 'error']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Berhasil logout!'
        ]);
    }
}
