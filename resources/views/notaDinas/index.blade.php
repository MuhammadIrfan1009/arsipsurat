@extends('layouts.sidebar')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Nota Dinas</span></h4>

    <div class="mb-3">
            <!-- Show 'Add New Letter' button only if the user is authenticated -->
            @auth
                <a href="{{ route('notaDinas.create') }}" class="btn btn-primary">Tambah Surat Baru</a>
            @else
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Tambah Surat Baru</button>
            @endauth
        </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($notaDinas->isEmpty())
        <p>Nota Dinas Tidak Tersedia.</p>
    @else
        <div class="card mb-4">
            <h5 class="card-header">Nota Dinas</h5>
            <div class="table-responsive text-nowrap p-3">
                <table id="suratMasukTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th>Selengkapnya</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($notaDinas as $index => $nota)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $nota->nomor_surat }}</td>
                                <td>{{ $nota->pengirim }}</td>
                                <td>{{ $nota->penerima }}</td>
                                <td>{{ $nota->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $nota->perihal }}</td>
                                <td>
                                <span>{{ ucfirst($nota->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('notaDinas.show', $nota->id) }}" class="btn btn-secondary btn-sm">View</a>
                                </td>
                                <td>
                                    <!-- Dropdown for Actions -->
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                             <!-- Tombol Edit dan Delete hanya jika pengguna sudah login -->
                                             @auth
                                                    <a class="dropdown-item" href="{{ route('notaDinas.edit', $nota->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    
                                                    <form action="{{ route('notaDinas.destroy', $nota->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <!-- Jika tidak login, tampilkan tombol untuk login -->
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal">
                                                        <i class="bx bx-lock me-1"></i> Edit / Delete (Login Required)
                                                    </button>
                                                @endauth
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
<!-- Modal for Login and Cancel -->
@auth
        <!-- If the user is authenticated, nothing is shown for login -->
    @else
        <!-- Show modal when trying to create, edit, or delete -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Anda harus login untuk melakukan tindakan ini. Apakah Anda ingin login?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
