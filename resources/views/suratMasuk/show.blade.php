@extends('layouts.sidebar')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Detail Surat Masuk</span></h4>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nomor Surat</th>
                    <td>{{ $suratMasuk->nomor_surat }}</td>
                </tr>
                <tr>
                    <th>Pengirim</th>
                    <td>{{ $suratMasuk->pengirim }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $suratMasuk->tanggal->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td>{{ $suratMasuk->perihal }}</td>
                </tr>
                <tr>
                    <th>Isi</th>
                    <td>{{ $suratMasuk->isi }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($suratMasuk->status) }}</td>
                </tr>
                <tr>
                    <th>Jenis Layanan</th>
                    <td>{{ $suratMasuk->jenis_layanan }}</td>
                </tr>
                @if($suratMasuk->jenis_layanan == 'Lainnya' && $suratMasuk->jenis_layanan_lainnya)
                <tr>
                    <th>Jenis Layanan Lainnya</th>
                    <td>{{ $suratMasuk->jenis_layanan_lainnya }}</td>
                </tr>
                @endif
                <tr>
                    <th>File</th>
                    <td>
                        @if($suratMasuk->file_path)
                            <a href="{{ Storage::url($suratMasuk->file_path) }}" target="_blank" class="btn btn-secondary btn-sm">Download File</a>
                        @else
                            <span>tidak ada file yang di upload.</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $suratMasuk->username }}</td>
                </tr>
            </table>

            <div class="d-flex justify-content-between">
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
        </div>
    </div>
</div>
@endsection
