<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\NotaDinas;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Total count data
        $totalSuratMasuk = SuratMasuk::count();
        $totalSuratKeluar = SuratKeluar::count();
        $totalNotaDinas = NotaDinas::count();
        $totalUsers = User::count();

        // Status count per table
       // Jenis layanan untuk surat masuk
        $jenisLayananSuratMasuk = SuratMasuk::select('jenis_layanan', DB::raw('count(*) as count'))
            ->groupBy('jenis_layanan')
            ->pluck('count', 'jenis_layanan');

        // Jenis layanan untuk surat keluar
        $jenisLayananSuratKeluar = SuratKeluar::select('jenis_layanan', DB::raw('count(*) as count'))
            ->groupBy('jenis_layanan')
            ->pluck('count', 'jenis_layanan');

        // Jenis layanan untuk nota dinas
        $jenisLayananNotaDinas = NotaDinas::select('jenis_layanan', DB::raw('count(*) as count'))
            ->groupBy('jenis_layanan')
            ->pluck('count', 'jenis_layanan');


        $roleUsers = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role');

       // Surat Masuk Monthly Count by Year and Month
// Surat Masuk Monthly Count by Year and Month
$suratMasukMonthly = SuratMasuk::select(
    DB::raw("YEAR(tanggal) as year"),
    DB::raw("MONTHNAME(tanggal) as month"),
    DB::raw("COUNT(*) as count")
)
->groupBy(DB::raw("YEAR(tanggal)"), DB::raw("MONTH(tanggal)"), DB::raw("MONTHNAME(tanggal)"))
->orderByRaw("YEAR(tanggal), MONTH(tanggal)")
->get()
->mapWithKeys(function ($item) {
    $yearMonth = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT); // e.g., "2024-01"
    return [$yearMonth => $item->count];
});

// Surat Keluar Monthly Count by Year and Month
$suratKeluarMonthly = SuratKeluar::select(
    DB::raw("YEAR(tanggal) as year"),
    DB::raw("MONTHNAME(tanggal) as month"),
    DB::raw("COUNT(*) as count")
)
->groupBy(DB::raw("YEAR(tanggal)"), DB::raw("MONTH(tanggal)"), DB::raw("MONTHNAME(tanggal)"))
->orderByRaw("YEAR(tanggal), MONTH(tanggal)")
->get()
->mapWithKeys(function ($item) {
    $yearMonth = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT); // e.g., "2024-01"
    return [$yearMonth => $item->count];
});

// Nota Dinas Monthly Count by Year and Month
$notaDinasMonthly = NotaDinas::select(
    DB::raw("YEAR(tanggal) as year"),
    DB::raw("MONTHNAME(tanggal) as month"),
    DB::raw("COUNT(*) as count")
)
->groupBy(DB::raw("YEAR(tanggal)"), DB::raw("MONTH(tanggal)"), DB::raw("MONTHNAME(tanggal)"))
->orderByRaw("YEAR(tanggal), MONTH(tanggal)")
->get()
->mapWithKeys(function ($item) {
    $yearMonth = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT); // e.g., "2024-01"
    return [$yearMonth => $item->count];
});



return view('home', compact(
    'totalSuratMasuk',
    'totalSuratKeluar',
    'totalNotaDinas',
    'totalUsers',
    'jenisLayananSuratMasuk',
    'jenisLayananSuratKeluar',
    'jenisLayananNotaDinas',
    'roleUsers',
    'suratMasukMonthly',
    'suratKeluarMonthly',
    'notaDinasMonthly'
));


    }
}
