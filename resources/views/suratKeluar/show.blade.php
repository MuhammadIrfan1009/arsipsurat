@extends('layouts.sidebar')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Surat Keluar</span></h4>

    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <!-- Nomor Surat -->
                <div class="col-md-6">
                    <label class="form-label" for="nomor_surat"><i class="bx bx-file"></i> Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" value="{{ $suratKeluar->nomor_surat }}" readonly>
                </div>

                <!-- Tujuan -->
                <div class="col-md-6">
                    <label class="form-label" for="tujuan"><i class="bx bx-user"></i> Tujuan</label>
                    <input type="text" class="form-control" id="tujuan" value="{{ $suratKeluar->tujuan }}" readonly>
                </div>

                <!-- Tanggal -->
                <div class="col-md-6">
                    <label class="form-label" for="tanggal"><i class="bx bx-calendar"></i> Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" value="{{ $suratKeluar->tanggal->format('d-m-Y') }}" readonly>
                </div>

                <!-- Perihal -->
                <div class="col-md-6">
                    <label class="form-label" for="perihal"><i class="bx bx-notepad"></i> Perihal</label>
                    <input type="text" class="form-control" id="perihal" value="{{ $suratKeluar->perihal }}" readonly>
                </div>

                <!-- Isi -->
                <div class="col-md-6">
                    <label class="form-label" for="isi"><i class="bx bx-message-detail"></i> Isi</label>
                    <textarea class="form-control" id="isi" rows="2" readonly>{{ $suratKeluar->isi }}</textarea>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label" for="status"><i class="bx bx-check-shield"></i> Status</label>
                    <input type="text" class="form-control" id="status" value="{{ ucfirst($suratKeluar->status) }}" readonly>
                </div>

                <!-- Jenis Layanan -->
                <div class="col-md-6">
                    <label class="form-label" for="jenis_layanan"><i class="bx bx-cog"></i> Jenis Layanan</label>
                    <input type="text" class="form-control" id="jenis_layanan" value="{{ $suratKeluar->jenis_layanan }}" readonly>
                </div>

                <!-- Jenis Layanan Lainnya (If applicable) -->
                @if($suratKeluar->jenis_layanan == 'Lainnya' && $suratKeluar->jenis_layanan_lainnya)
                <div class="col-md-6">
                    <label class="form-label" for="jenis_layanan_lainnya"><i class="bx bx-info-circle"></i> Jenis Layanan Lainnya</label>
                    <input type="text" class="form-control" id="jenis_layanan_lainnya" value="{{ $suratKeluar->jenis_layanan_lainnya }}" readonly>
                </div>
                @endif

                <!-- File -->
                <div class="col-md-6">
                    <label class="form-label" for="file"><i class="bx bx-link-alt"></i> File</label>
                    <div class="input-group input-group-merge">
                        @if($suratKeluar->file_path)
                            <a href="{{ Storage::url($suratKeluar->file_path) }}" target="_blank" class="btn btn-primary btn-sm px-4">Download File</a>
                        @else
                            <span class="form-text">Tidak ada file yang diunggah.</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="username"><i class="bx bx-user-circle"></i> Pengunggah</label>
                    <input type="text" class="form-control" id="username" value="{{ $suratKeluar->username }}" readonly>
                </div>

                <div class="col-12 d-flex justify-content-between mt-4">
                    <a href="{{ route('suratKeluar.index') }}" class="btn btn-secondary">Kembali</a>
                    <div>
                        <a href="{{ route('suratKeluar.edit', $suratKeluar->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('suratKeluar.destroy', $suratKeluar->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this letter?')">Delete</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
