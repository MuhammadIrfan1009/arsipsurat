<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class NotaDinasController extends Controller
{
    public function index()
    {
        $notaDinas = NotaDinas::all();
        return view('notaDinas.index', compact('notaDinas'));
    }

    public function create()
    {
        return view('notaDinas.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nomor_surat' => 'required|string',
        'pengirim' => 'required|string',
        'penerima' => 'required|string',
        'tanggal' => 'required|date',
        'perihal' => 'required|string',
        'isi' => 'required|string',
        'status' => 'required|in:Draft,Sedang Proses,Terkirim,Diterima,Arsip',
        'jenis_layanan' => 'nullable|string',
        'username' => 'nullable|string', 
    ]);

    $username = auth()->user() ? auth()->user()->username : $request->username;

    $year = date('Y', strtotime($request->tanggal));

    $existingNotaDinas = NotaDinas::where('nomor_surat', $request->nomor_surat)
                                  ->where('pengirim', $request->pengirim)
                                  ->whereYear('tanggal', $year)
                                  ->first();

    if ($existingNotaDinas) {
        return redirect()->back()->with('warning', 'Nota Dinas dengan kombinasi nomor surat, pengirim, dan tahun yang sama sudah ada.');
    }

    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('uploads/nota_dinas', 'public');
    }

    try {
        NotaDinas::create([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
            'isi' => $request->isi,
            'status' => $request->status,
            'file_path' => $filePath, 
            'jenis_layanan' => $request->jenis_layanan,
            'username' => $username, 
        ]);

        return redirect()->route('notaDinas.index')->with('success', 'Nota Dinas berhasil dibuat!');
    } catch (QueryException $e) {
        if ($e->errorInfo[1] == 1062) {
            return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, pengirim, dan tahun yang sama sudah ada.');
        }
        Log::error('Error storing Nota Dinas: ' . $e->getMessage());

        return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
    }
}

    public function show($id)
    {
        $notaDinas = NotaDinas::findOrFail($id);
        return view('notaDinas.show', compact('notaDinas'));
    }


    public function edit($id)
    {
        $notaDinas = NotaDinas::findOrFail($id);
        return view('notaDinas.edit', compact('notaDinas'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nomor_surat' => 'required|string|unique:nota_dinas,nomor_surat,' . $id,
        'pengirim' => 'required|string',
        'penerima' => 'required|string',
        'tanggal' => 'required|date',
        'perihal' => 'required|string',
        'isi' => 'required|string',
        'status' => 'required|in:Draft,Sedang Proses,Terkirim,Diterima,Arsip',
        'file_path' => 'nullable|file|mimes:pdf,jpeg,png',
        'jenis_layanan' => 'nullable|string',
        'username' => 'nullable|string', 
    ]);

    $notaDinas = NotaDinas::findOrFail($id);

    $username = auth()->user() ? auth()->user()->username : $request->username;

    $year = date('Y', strtotime($request->tanggal));

    $existingNotaDinas = NotaDinas::where('nomor_surat', $request->nomor_surat)
                                  ->where('pengirim', $request->pengirim)
                                  ->whereYear('tanggal', $year)
                                  ->where('id', '!=', $id) 
                                  ->first();

    if ($existingNotaDinas) {
        return redirect()->back()->with('warning', 'Nota Dinas dengan kombinasi nomor surat, pengirim, dan tahun yang sama sudah ada.');
    }

    $filePath = $notaDinas->file_path;
    if ($request->hasFile('file_path')) {
        if ($notaDinas->file_path && Storage::exists($notaDinas->file_path)) {
            Storage::delete($notaDinas->file_path);
        }
        $filePath = $request->file('file_path')->store('uploads/nota_dinas', 'public');
    }

    try {
        $notaDinas->update([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
            'isi' => $request->isi,
            'status' => $request->status,
            'file_path' => $filePath, 
            'jenis_layanan' => $request->jenis_layanan,
            'username' => $username, 
        ]);

        return redirect()->route('notaDinas.index')->with('success', 'Nota Dinas berhasil diperbarui!');
    } catch (QueryException $e) {
        if ($e->errorInfo[1] == 1062) {
            return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, pengirim, dan tahun yang sama sudah ada.');
        }
        Log::error('Error updating Nota Dinas: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
    }
}

    public function destroy($id)
    {
        $notaDinas = NotaDinas::findOrFail($id);

        if ($notaDinas->file_path && Storage::exists($notaDinas->file_path)) {
            Storage::delete($notaDinas->file_path);
        }

        $notaDinas->delete();

        return redirect()->route('notaDinas.index')->with('success', 'Nota Dinas berhasil dihapus!');
    }
}
