<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuk = SuratMasuk::all();
        return view('suratMasuk.index', compact('suratMasuk'));
    }

    public function create()
    {
        return view('suratMasuk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Baru,Menanggapi,Menunggu Keputusan,Telah Diarsip',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'jenis_layanan' => 'nullable|string|max:255',
            'jenis_layanan_lainnya' => 'nullable|string|max:255',  
        ]);

        $validated['tahun_tanggal'] = date('Y', strtotime($request->tanggal));
    
        $existingSurat = SuratMasuk::where('nomor_surat', $request->nomor_surat)
                                    ->where('pengirim', $request->pengirim)
                                    ->whereYear('tanggal', $validated['tahun_tanggal'])
                                    ->first();
    
        if ($existingSurat) {
            return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, pengirim, dan tahun yang sama sudah ada.');
        }
    
        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('uploads/surat_masuk', 'public');
        }
    
        $validated['username'] = auth()->user()->username;
    
        try {
            SuratMasuk::create($validated);
            return redirect()->route('suratMasuk.index')->with('success', 'Surat Masuk berhasil ditambahkan!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, pengirim, dan tahun yang sama sudah ada.');
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }



    public function show(SuratMasuk $suratMasuk)
    {
        return view('suratMasuk.show', compact('suratMasuk'));
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        return view('suratMasuk.edit', compact('suratMasuk'));
    }

    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Baru,Menanggapi,Menunggu Keputusan,Telah Diarsip',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'jenis_layanan' => 'nullable|string|max:255',
            'jenis_layanan_lainnya' => 'nullable|string|max:255',
        ]);

        if ($request->jenis_layanan === 'Lainnya' && $request->filled('jenis_layanan_lainnya')) {
            $validated['jenis_layanan'] = $request->jenis_layanan_lainnya;
        }

        if ($request->hasFile('file')) {
            if ($suratMasuk->file_path) {
                Storage::delete('public/' . $suratMasuk->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('uploads/surat_masuk', 'public');
        }

        try {
            $suratMasuk->update($validated);
            return redirect()->route('suratMasuk.index')->with('success', 'Surat Masuk berhasil diubah!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, pengirim, dan tahun yang sama sudah ada.');
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        if ($suratMasuk->file_path) {
            Storage::disk('public')->delete($suratMasuk->file_path);
        }

        $suratMasuk->delete();

        return redirect()->route('suratMasuk.index')->with('success', 'Surat Masuk berhasil dihapus!');
    }
}
