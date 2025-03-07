@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card" style="max-width: 500px; margin: auto;">
                <div class="card-body">
                    <!-- Logo atau Branding -->
                    <div class="app-brand justify-content-center mb-4">
                        <img src="{{ asset('assets/img/favicon/favicon.png') }}" alt="YourApp Logo" class="app-brand-logo demo" style="height: 100px;">
                    </div>
                   

                    <h4 class="mb-2 text-center">Welcome! 🚀</h4>
                    <p class="mb-4 text-center">Silahkan mendaftar jika belum memiliki akun.</p>
                    
                    <!-- Pesan Sukses Pendaftaran -->
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('auth.register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama</label>
                            <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" class="form-control" id="password" required>
                                <span class="input-group-text cursor-pointer password-toggle">
                                    <i class="bx bx-hide"></i>
                                </span>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                <span class="input-group-text cursor-pointer password-toggle">
                                    <i class="bx bx-hide"></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary d-grid w-100">Register</button>
                        
                        <p class="text-center mt-3 text-muted">
                            Setelah mendaftar, akun Anda akan menunggu persetujuan dari admin.
                        </p>
                        <p class="text-center mt-3">
                            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
