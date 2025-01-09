@extends('layouts.sidebar')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y mt-5">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Surat Masuk /</span> Edit Surat Masuk</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Surat Masuk Form</h5>
            <small class="text-muted float-end">Update the necessary details</small>
        </div>
        <div class="card-body">
            <form action="{{ route('suratMasuk.update', $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="nomor_surat" class="col-sm-2 col-form-label">Nomor Surat</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
                    <div class="col-sm-10">
                        <input type="text" name="pengirim" id="pengirim" class="form-control" value="{{ old('pengirim', $suratMasuk->pengirim) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $suratMasuk->tanggal->format('Y-m-d')) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
                    <div class="col-sm-10">
                        <input type="text" name="perihal" id="perihal" class="form-control" value="{{ old('perihal', $suratMasuk->perihal) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="isi" class="col-sm-2 col-form-label">Isi</label>
                    <div class="col-sm-10">
                        <textarea name="isi" id="isi" class="form-control" rows="4" required>{{ old('isi', $suratMasuk->isi) }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="form-control" required>
                            <option value="Baru" {{ old('status', $suratMasuk->status) == 'Baru' ? 'selected' : '' }}>Baru</option>
                            <option value="Menanggapi" {{ old('status', $suratMasuk->status) == 'Menanggapi' ? 'selected' : '' }}>Menanggapi</option>
                            <option value="Menunggu Keputusan" {{ old('status', $suratMasuk->status) == 'Menunggu Keputusan' ? 'selected' : '' }}>Menunggu Keputusan</option>
                            <option value="Telah Diarsip" {{ old('status', $suratMasuk->status) == 'Telah Diarsip' ? 'selected' : '' }}>Telah Diarsip</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="file" class="col-sm-2 col-form-label">File (PDF/DOC/DOCX, max 2MB)</label>
                    <div class="col-sm-10">
                        <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx">
                        @if ($suratMasuk->file_path)
                            <p>Current file: <a href="{{ asset('storage/' . $suratMasuk->file_path) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                </div>

                <!-- Jenis Layanan with dynamic behavior for 'Lainnya' option -->
                @php
                    $predefinedLayanan = ['Live Streaming', 'Jaringan', 'Pembuatan Aplikasi', 'Pembuatan Subdomain & Hosting'];
                    $isCustomLayanan = !in_array($suratMasuk->jenis_layanan, $predefinedLayanan);
                @endphp
                <div class="row mb-3">
                    <label for="jenis_layanan" class="col-sm-2 col-form-label">Jenis Layanan</label>
                    <div class="col-sm-10">
                        <select name="jenis_layanan" id="jenis_layanan" class="form-control" required>
                            <option value="Live Streaming" {{ old('jenis_layanan', $suratMasuk->jenis_layanan) == 'Live Streaming' ? 'selected' : '' }}>Live Streaming</option>
                            <option value="Jaringan" {{ old('jenis_layanan', $suratMasuk->jenis_layanan) == 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                            <option value="Pembuatan Aplikasi" {{ old('jenis_layanan', $suratMasuk->jenis_layanan) == 'Pembuatan Aplikasi' ? 'selected' : '' }}>Pembuatan Aplikasi</option>
                            <option value="Pembuatan Subdomain & Hosting" {{ old('jenis_layanan', $suratMasuk->jenis_layanan) == 'Pembuatan Subdomain & Hosting' ? 'selected' : '' }}>Pembuatan Subdomain & Hosting</option>
                            <option value="Lainnya" {{ $isCustomLayanan ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <input type="text" name="jenis_layanan_lainnya" id="jenis_layanan_lainnya" class="form-control mt-2" placeholder="Isi jenis layanan lainnya" 
                            style="display: {{ $isCustomLayanan || old('jenis_layanan', $suratMasuk->jenis_layanan) == 'Lainnya' ? 'block' : 'none' }};" 
                            value="{{ old('jenis_layanan_lainnya', $isCustomLayanan ? $suratMasuk->jenis_layanan : '') }}">
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update Letter</button>
                        <a href="{{ route('suratMasuk.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const jenisLayananSelect = document.getElementById('jenis_layanan');
    const jenisLayananLainnya = document.getElementById('jenis_layanan_lainnya');

    jenisLayananSelect.addEventListener('change', function () {
        jenisLayananLainnya.style.display = jenisLayananSelect.value === 'Lainnya' ? 'block' : 'none';
    });

    // Pre-check if 'Lainnya' is selected, display input for it
    if (jenisLayananSelect.value === 'Lainnya') {
        jenisLayananLainnya.style.display = 'block';
    }
</script>
@endsection
