<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the incoming letters.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $suratMasuk = SuratMasuk::all(); 
        return view('suratmasuk.index', compact('suratMasuk'));
    }

    /**
     * Show the form for creating a new incoming letter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('suratmasuk.create'); // Show form to create a new letter
    }

    /**
     * Store a newly created incoming letter in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk',
            'pengirim' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:baru,proses,selesai',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // File validation
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads/surat_masuk', 'public'); // Store file in 'storage/app/public/uploads/surat_masuk'
        }

        // Create a new incoming letter
        SuratMasuk::create([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
            'isi' => $request->isi,
            'status' => $request->status,
            'file_path' => $filePath,
        ]);

        return redirect()->route('suratMasuk.index')->with('success', 'Incoming letter created successfully!');
    }

    /**
     * Display the specified incoming letter.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\View\View
     */
    public function show(SuratMasuk $suratMasuk)
    {
        return view('suratmasuk.show', compact('suratMasuk')); // Show details of the letter
    }

    /**
     * Show the form for editing the specified incoming letter.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\View\View
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('suratmasuk.edit', compact('suratMasuk')); // Show form to edit the letter
    }

    /**
     * Update the specified incoming letter in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|string|max:255|unique:surat_masuk,nomor_surat,' . $suratMasuk->id,
            'pengirim' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:baru,proses,selesai',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($suratMasuk->file_path) {
                Storage::disk('public')->delete($suratMasuk->file_path);
            }

            $file = $request->file('file');
            $filePath = $file->store('uploads/surat_masuk', 'public');
            $suratMasuk->file_path = $filePath;
        }

        // Update the incoming letter
        $suratMasuk->update([
            'nomor_surat' => $request->nomor_surat,
            'pengirim' => $request->pengirim,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
            'isi' => $request->isi,
            'status' => $request->status,
            'file_path' => $suratMasuk->file_path ?? null,
        ]);

        return redirect()->route('suratMasuk.index')->with('success', 'Incoming letter updated successfully!');
    }

    /**
     * Remove the specified incoming letter from the database.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        // Delete file if exists
        if ($suratMasuk->file_path) {
            Storage::disk('public')->delete($suratMasuk->file_path);
        }

        $suratMasuk->delete(); // Delete the incoming letter
        return redirect()->route('suratMasuk.index')->with('success', 'Incoming letter deleted successfully!');
    }

    
}
