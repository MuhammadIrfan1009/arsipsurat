@extends('layouts.app')

@section('title', 'E-Komdigi')

@section('content')
    <div class="landing-page" style="position: relative; height: 100vh; background: url('{{ asset('assets/img/favicon/favicon.png') }}') no-repeat center center fixed; background-size: cover;">
        <div class="d-flex justify-content-center align-items-center" style="height: 100%; text-align: center;">
            <a href="{{ route('home') }}" class="btn btn-primary" >
                Masuk
            </a>
        </div>
    </div>
@endsection
