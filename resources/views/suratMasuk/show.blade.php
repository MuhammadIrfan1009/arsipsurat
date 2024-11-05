<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat Masuk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Surat Masuk</h2>

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
                <th>File</th>
                <td>
                    @if($suratMasuk->file_path)
                        <a href="{{ Storage::url($suratMasuk->file_path) }}" target="_blank">Download File</a>
                    @else
                        No file uploaded.
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('suratMasuk.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('suratMasuk.edit', $suratMasuk->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('suratMasuk.destroy', $suratMasuk->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this letter?')">Delete</button>
        </form>
    </div>
</body>
</html>
