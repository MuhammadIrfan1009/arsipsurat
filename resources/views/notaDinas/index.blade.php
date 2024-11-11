@extends('layouts.sidebar')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Surat Masuk</span></h4>

        <div class="mb-3">
            <a href="{{ route('suratMasuk.create') }}" class="btn btn-primary">Add New Letter</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($suratMasuk->isEmpty())
            <p>Surat Tidak Tersedia.</p>
        @else
            <div class="card">
                <h5 class="card-header">Surat Masuk</h5>
                <div class="table-responsive text-nowrap">
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Pengirim</th>
                                <th>Tanggal</th>
                                <th>Perihal</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($suratMasuk as $index => $surat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->tanggal->format('d-m-Y') }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ strtolower($surat->status) }} me-1">{{ ucfirst($surat->status) }}</span>
                                    </td>
                                    <td>
                                        @if($surat->file_path)
                                            <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="btn btn-secondary btn-sm">Download</a>
                                        @else
                                            <span class="text-muted">No file</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Dropdown for Actions -->
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('suratMasuk.show', $surat->id) }}">
                                                    <i class="bx bx-eye me-1"></i> View
                                                </a>
                                                <a class="dropdown-item" href="{{ route('suratMasuk.edit', $surat->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('suratMasuk.destroy', $surat->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
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
@endsection
