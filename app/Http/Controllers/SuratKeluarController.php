<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = SuratKeluar::all();
        return view('suratKeluar.index', compact('suratKeluar'));
    }

    public function create()
    {
        return view('suratKeluar.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Draft,Proses Persetujuan,Disetujui,Terkirim',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'jenis_layanan' => 'nullable|string|max:255',
            'jenis_layanan_lainnya' => 'nullable|string|max:255',  
        ]);

        $validated['tahun_tanggal'] = date('Y', strtotime($request->tanggal));
    
        $existingSurat = SuratKeluar::where('nomor_surat', $request->nomor_surat)
                                    ->where('tujuan', $request->pengirim)
                                    ->whereYear('tanggal', $validated['tahun_tanggal'])
                                    ->first();
    
        if ($existingSurat) {
            return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, tujuan, dan tahun yang sama sudah ada.');
        }
    
        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('uploads/surat_keluar', 'public');
        }
    
        $validated['username'] = auth()->user()->username;
    
        try {
            SuratKeluar::create($validated);
            return redirect()->route('suratKeluar.index')->with('success', 'Surat Keluar berhasil ditambahkan!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, tujuan, dan tahun yang sama sudah ada.');
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }



    public function show(SuratKeluar $suratKeluar)
    {
        return view('suratKeluar.show', compact('suratKeluar'));
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        return view('suratKeluar.edit', compact('suratKeluar'));
    }

    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:Draft,Proses Persetujuan,Disetujui, Terkirim',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'jenis_layanan' => 'nullable|string|max:255',
            'jenis_layanan_lainnya' => 'nullable|string|max:255',
        ]);

        if ($request->jenis_layanan === 'Lainnya' && $request->filled('jenis_layanan_lainnya')) {
            $validated['jenis_layanan'] = $request->jenis_layanan_lainnya;
        }

        if ($request->hasFile('file')) {
            if ($suratKeluar->file_path) {
                Storage::delete('public/' . $suratKeluar->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('uploads/surat_keluar', 'public');
        }

        try {
            $suratKeluar->update($validated);
            return redirect()->route('suratKeluar.index')->with('success', 'Surat Keluar berhasil diubah!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('warning', 'Data dengan kombinasi nomor surat, tujuan, dan tahun yang sama sudah ada.');
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        if ($suratKeluar->file_path) {
            Storage::disk('public')->delete($suratKeluar->file_path);
        }

        $suratKeluar->delete();

        return redirect()->route('suratKeluar.index')->with('success', 'Surat Keluar berhasil dihapus!');
    }
}