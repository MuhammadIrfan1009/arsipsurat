@extends('layouts.app')

@section('title', 'E-Komdigi')

@section('content')
<div class="landing-page" style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background: url('{{ asset('assets/img/backgrounds/landing.png') }}') no-repeat center center; background-size: cover; z-index: -1;">
    <div class="d-flex justify-content-center align-items-center" style="height: 100%; text-align: center;">
        <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 125px;">
            Masuk
        </a>
    </div>
    
    </div>
@endsection