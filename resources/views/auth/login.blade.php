@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card" style="max-width: 500px; margin: auto;">
                <div class="card-body">
                    <!-- Logo or Branding -->
                    <div class="app-brand justify-content-center mb-4">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <img src="{{ asset('assets/img/favicon/favicon.png') }}" alt="YourApp Logo" class="app-brand-logo demo" style="height: 100px;">
                        </a>
                    </div>
                    <!-- /Logo or Branding -->

                    <h4 class="mb-2 text-center">Welcome Back! 🚀</h4>
                    <p class="mb-4 text-center">Silahkan Login.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" class="form-control" id="password" required>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
                        <p class="text-center mt-3">
                            Belum punya akun? <a href="{{ route('auth.register.form') }}">Daftar di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
