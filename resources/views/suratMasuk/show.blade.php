@extends('layouts.sidebar')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Surat Masuk</span></h4>

    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="nomor_surat"><i class="bx bx-file"></i> Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" value="{{ $suratMasuk->nomor_surat }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="pengirim"><i class="bx bx-user"></i> Pengirim</label>
                    <input type="text" class="form-control" id="pengirim" value="{{ $suratMasuk->pengirim }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="tanggal"><i class="bx bx-calendar"></i> Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" value="{{ $suratMasuk->tanggal->format('d-m-Y') }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="perihal"><i class="bx bx-notepad"></i> Perihal</label>
                    <input type="text" class="form-control" id="perihal" value="{{ $suratMasuk->perihal }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="isi"><i class="bx bx-message-detail"></i> Isi</label>
                    <textarea class="form-control" id="isi" rows="2" readonly>{{ $suratMasuk->isi }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="status"><i class="bx bx-check-shield"></i> Status</label>
                    <input type="text" class="form-control" id="status" value="{{ ucfirst($suratMasuk->status) }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="jenis_layanan"><i class="bx bx-cog"></i> Jenis Layanan</label>
                    <input type="text" class="form-control" id="jenis_layanan" value="{{ $suratMasuk->jenis_layanan }}" readonly>
                </div>

                @if($suratMasuk->jenis_layanan == 'Lainnya' && $suratMasuk->jenis_layanan_lainnya)
                <div class="col-md-6">
                    <label class="form-label" for="jenis_layanan_lainnya"><i class="bx bx-info-circle"></i> Jenis Layanan Lainnya</label>
                    <input type="text" class="form-control" id="jenis_layanan_lainnya" value="{{ $suratMasuk->jenis_layanan_lainnya }}" readonly>
                </div>
                @endif

                <div class="col-md-6">
                    <label class="form-label" for="file"><i class="bx bx-link-alt"></i> File</label>
                    <div class="input-group input-group-merge">
                        @if($suratMasuk->file_path)
                            <a href="{{ Storage::url($suratMasuk->file_path) }}" target="_blank" class="btn btn-primary btn-sm px-4">Download File</a>
                        @else
                            <span class="form-text">Tidak ada file yang diunggah.</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="username"><i class="bx bx-user-circle"></i> Pengunggah</label>
                    <input type="text" class="form-control" id="username" value="{{ $suratMasuk->username }}" readonly>
                </div>

                <div class="col-12 d-flex justify-content-between mt-4">
                    <a href="{{ route('suratMasuk.index') }}" class="btn btn-secondary">Kembali</a>
                    <div>
                        <a href="{{ route('suratMasuk.edit', $suratMasuk->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('suratMasuk.destroy', $suratMasuk->id) }}" method="POST" style="display:inline;">
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
