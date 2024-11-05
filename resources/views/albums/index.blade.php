@extends('layouts.app')

@section('content')
<div style="margin: 20px;">
    <h2>Daftar Album</h2>
    <table style="border-collapse: collapse; width: 100%;" border="1">
        <thead>
            <tr>
                <th>Nama Album</th>
                <th>Deskripsi</th>
                <th><a href="{{ route('albums.create') }}">Tambah Album</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
            <tr>
                <td>
                    <a href="{{ route('albums.photos', $album->albumID) }}">
                        {{ $album->namaAlbum }}
                    </a>
                </td>
                <td>{{ $album->deskripsi }}</td>
                <td style="text-align: center;">
                    <a href="{{ route('albums.edit', $album->albumID) }}">Edit</a>
                    <form action="{{ route('albums.destroy', $album->albumID) }}" method="POST" style="display: inline;" 
                          onsubmit="return confirm('Tindakkan ini tidak bisa dibatalkan');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
