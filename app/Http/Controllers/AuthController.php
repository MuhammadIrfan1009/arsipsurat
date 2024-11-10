<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Membuat pengguna baru dengan status 'pending'
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'pending', // Set status awal sebagai 'pending'
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Akun Anda menunggu persetujuan.');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        // Periksa apakah pengguna ada dan apakah statusnya 'approved'
        if ($user && $user->status !== 'approved') {
            return redirect()->back()->withErrors(['email' => 'Akun Anda menunggu persetujuan.'])->withInput();
        }

        // Autentikasi pengguna
        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        // Redirect ke halaman utama setelah login berhasil
        return redirect()->route('suratMasuk.index');
    }

    public function logout()
    {
        // Logout pengguna yang sedang aktif
        Auth::logout();
        return redirect()->route('login'); // Redirect ke halaman login
    }
}
