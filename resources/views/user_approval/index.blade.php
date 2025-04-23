@extends('layouts.sidebar')

@section('title', 'User Approval')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Persetujuan /</span> User Approval</h4>

    <!-- Success and Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- User Approval Table -->
    <div class="card">
        <h5 class="card-header">Daftar User Menunggu Persetujuan</h5>
        <div class="table-responsive text-nowrap p-3">
            <table id="suratMasukTable"  class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($pendingUsers as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-label-warning">{{ ucfirst($user->status) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('user_approval.approve', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
