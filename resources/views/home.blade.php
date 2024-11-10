@extends('layouts.sidebar')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h1>Welcome to eKomdigi</h1>

        @if (Auth::check())
            <p>Hello, {{ Auth::user()->nama }}!</p>
            <p>Your role is: {{ Auth::user()->role }}</p>

            <h2>Your Dashboard</h2>
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
            <p>Please <a href="{{ route('auth.login') }}">login</a> to access your dashboard.</p>
        @endif
    </div>
@endsection
