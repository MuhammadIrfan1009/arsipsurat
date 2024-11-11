@extends('layouts.sidebar')

@section('content')
<div class="container mt-5">
    <h1>Create Surat Masuk</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suratMasuk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table">
            <tr>
                <td><label for="nomor_surat" class="form-label">Nomor Surat</label></td>
                <td><input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}" required></td>
            </tr>
            <tr>
                <td><label for="pengirim" class="form-label">Pengirim</label></td>
                <td><input type="text" name="pengirim" id="pengirim" class="form-control" value="{{ old('pengirim') }}" required></td>
            </tr>
            <tr>
                <td><label for="tanggal" class="form-label">Tanggal</label></td>
                <td><input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}" required></td>
            </tr>
            <tr>
                <td><label for="perihal" class="form-label">Perihal</label></td>
                <td><input type="text" name="perihal" id="perihal" class="form-control" value="{{ old('perihal') }}" required></td>
            </tr>
            <tr>
                <td><label for="isi" class="form-label">Isi</label></td>
                <td><textarea name="isi" id="isi" class="form-control" rows="4" required>{{ old('isi') }}</textarea></td>
            </tr>
            <tr>
                <td><label for="status" class="form-label">Status</label></td>
                <td>
                    <select name="status" id="status" class="form-control" required>
                        <option value="baru" {{ old('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="file" class="form-label">File (PDF/DOC/DOCX, max 2MB)</label></td>
                <td><input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx"></td>
            </tr>
            <tr>
                <td><label for="jenis_layanan" class="form-label">Jenis Layanan</label></td>
                <td>
                    <select name="jenis_layanan" id="jenis_layanan" class="form-control" required>
                        <option value="Live Streaming" {{ old('jenis_layanan') == 'Live Streaming' ? 'selected' : '' }}>Live Streaming</option>
                        <option value="Jaringan" {{ old('jenis_layanan') == 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                        <option value="Pembuatan Aplikasi" {{ old('jenis_layanan') == 'Pembuatan Aplikasi' ? 'selected' : '' }}>Pembuatan Aplikasi</option>
                        <option value="Pembuatan Subdomain & Hosting" {{ old('jenis_layanan') == 'Pembuatan Subdomain & Hosting' ? 'selected' : '' }}>Pembuatan Subdomain & Hosting</option>
                        <option value="Lainnya" {{ old('jenis_layanan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <input type="text" name="jenis_layanan_lainnya" id="jenis_layanan_lainnya" class="form-control mt-2" placeholder="Isi jenis layanan lainnya" style="display: none;">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary">Tambah Surat</button>
                    <a href="{{ route('suratMasuk.index') }}" class="btn btn-secondary">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    const jenisLayananSelect = document.getElementById('jenis_layanan');
    const jenisLayananLainnya = document.getElementById('jenis_layanan_lainnya');

    jenisLayananSelect.addEventListener('change', function () {
        if (jenisLayananSelect.value === 'Lainnya') {
            jenisLayananLainnya.style.display = 'block';
        } else {
            jenisLayananLainnya.style.display = 'none';
        }
    });

    // When submitting the form, if "Lainnya" is selected and the user has typed something,
    // change the selected value of the "jenis_layanan" to the typed value.
    document.querySelector('form').addEventListener('submit', function (event) {
        if (jenisLayananSelect.value === 'Lainnya' && jenisLayananLainnya.value) {
            jenisLayananSelect.value = jenisLayananLainnya.value;
        }
    });
</script>
@endsection
