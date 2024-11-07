@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat Masuk</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Surat Masuk</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('suratMasuk.update', $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <table class="table">
                <tr>
                    <td><label for="nomor_surat" class="form-label">Nomor Surat</label></td>
                    <td><input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}" required></td>
                </tr>
                <tr>
                    <td><label for="pengirim" class="form-label">Pengirim</label></td>
                    <td><input type="text" name="pengirim" id="pengirim" class="form-control" value="{{ old('pengirim', $suratMasuk->pengirim) }}" required></td>
                </tr>
                <tr>
                    <td><label for="tanggal" class="form-label">Tanggal</label></td>
                    <td><input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $suratMasuk->tanggal->format('Y-m-d')) }}" required></td>
                </tr>
                <tr>
                    <td><label for="perihal" class="form-label">Perihal</label></td>
                    <td><input type="text" name="perihal" id="perihal" class="form-control" value="{{ old('perihal', $suratMasuk->perihal) }}" required></td>
                </tr>
                <tr>
                    <td><label for="isi" class="form-label">Isi</label></td>
                    <td><textarea name="isi" id="isi" class="form-control" rows="4" required>{{ old('isi', $suratMasuk->isi) }}</textarea></td>
                </tr>
                <tr>
                    <td><label for="status" class="form-label">Status</label></td>
                    <td>
                        <select name="status" id="status" class="form-control" required>
                            <option value="baru" {{ (old('status', $suratMasuk->status) == 'baru') ? 'selected' : '' }}>Baru</option>
                            <option value="proses" {{ (old('status', $suratMasuk->status) == 'proses') ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ (old('status', $suratMasuk->status) == 'selesai') ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="file" class="form-label">File (PDF/DOC/DOCX, max 2MB)</label></td>
                    <td>
                        <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx">
                        <small>Biarkan kosong jika tidak ingin mengganti file.</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary">Update Letter</button>
                        <a href="{{ route('suratMasuk.index') }}" class="btn btn-secondary">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
@endsection