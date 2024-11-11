<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
   

    // Display a listing of SuratMasuk
    public function index()
    {
        $suratMasuk = SuratMasuk::all();
        return view('suratmasuk.index', compact('suratMasuk'));
    }

    // Show the form for creating a new SuratMasuk
    public function create()
    {
        return view('suratMasuk.create');
    }

    // Store a newly created SuratMasuk in storage
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:baru,proses,selesai',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'jenis_layanan' => 'nullable|string|max:255',
            'jenis_layanan_lainnya' => 'nullable|string|max:255',  // Add validation for 'jenis_layanan_lainnya'
        ]);

        // Check if "Lainnya" is selected and a custom service type is provided
        if ($request->jenis_layanan === 'Lainnya' && $request->filled('jenis_layanan_lainnya')) {
            $validated['jenis_layanan'] = $request->jenis_layanan_lainnya;
        }

        // Handle file upload if present
        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('uploads/surat_masuk', 'public');
        }

        // Automatically set username based on the authenticated user
        $validated['username'] = auth()->user()->username;

        // Create SuratMasuk record
        SuratMasuk::create($validated);

        return redirect()->route('suratMasuk.index')->with('success', 'Incoming letter created successfully!');
    }

    // Display the specified SuratMasuk
    public function show(SuratMasuk $suratMasuk)
    {
        return view('suratmasuk.show', compact('suratMasuk'));
    }

    // Show the form for editing the specified SuratMasuk
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('suratmasuk.edit', compact('suratMasuk'));
    }

    // Update the specified SuratMasuk in storage
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:baru,proses,selesai',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'jenis_layanan' => 'nullable|string|max:255',
            'jenis_layanan_lainnya' => 'nullable|string|max:255',
        ]);

        // Check if "Lainnya" is selected and a custom service type is provided
        if ($request->jenis_layanan === 'Lainnya' && $request->filled('jenis_layanan_lainnya')) {
            $validated['jenis_layanan'] = $request->jenis_layanan_lainnya;
        }

        // Handle file upload if present
        if ($request->hasFile('file')) {
            // Delete old file if it exists
            if ($suratMasuk->file_path) {
                Storage::delete('public/' . $suratMasuk->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('uploads/surat_masuk', 'public');
        }

        // Update SuratMasuk record
        $suratMasuk->update($validated);

        return redirect()->route('suratMasuk.index')->with('success', 'Surat Masuk updated successfully!');
    }

    // Remove the specified SuratMasuk from storage
    public function destroy(SuratMasuk $suratMasuk)
    {
        // Delete file if it exists
        if ($suratMasuk->file_path) {
            Storage::disk('public')->delete($suratMasuk->file_path);
        }

        // Delete SuratMasuk record
        $suratMasuk->delete();

        return redirect()->route('suratMasuk.index')->with('success', 'Incoming letter deleted successfully!');
    }
}
