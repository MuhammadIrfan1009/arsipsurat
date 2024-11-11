@extends('layouts.sidebar')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h1>Selamat datang di E-Komdigi</h1>

        @if (Auth::check())
            <p>Hello, {{ Auth::user()->username }}!</p>
            <p>Your role is: {{ Auth::user()->role }}</p>

            <form action="{{ route('suratMasuk.index') }}" method="GET" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Surat Masuk</button>
            </form>
            
            <!-- Update Route for Cek Akses -->
            @if (Auth::user()->role == 'admin') <!-- Optional: Only show for admin -->
                <form action="{{ route('user_approval.index') }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Cek Akses</button>
                </form>
            @endif

            <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        @else
            <p>Mohon <a href="{{ route('auth.login') }}">login</a> untuk mengakses dashboard.</p>
        @endif
    </div>
@endsection
