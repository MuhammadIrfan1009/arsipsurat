

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Masuk</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Surat Masuk</h1>

        <div class="mb-3">
            <a href="{{ route('suratMasuk.create') }}" class="btn btn-primary">Add New Letter</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($suratMasuk->isEmpty())
            <p>No incoming letters available.</p>
        @else
            <table class="table table-bordered">
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
                <tbody>
                    @foreach ($suratMasuk as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ $surat->pengirim }}</td>
                            <td>{{ $surat->tanggal->format('d-m-Y') }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>{{ ucfirst($surat->status) }}</td>
                            <td>
                                @if($surat->file_path)
                                    <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank" class="btn btn-secondary">Download</a>
                                @else
                                    No file
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('suratMasuk.show', $surat->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('suratMasuk.edit', $surat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('suratMasuk.destroy', $surat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
