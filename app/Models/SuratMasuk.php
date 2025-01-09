<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'surat_masuk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_surat',
        'pengirim',
        'tanggal',
        'perihal',
        'isi',
        'status',
        'file_path',
        'jenis_layanan',
        'username',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    
    public function getTahunTanggalAttribute()
    {
        return $this->tanggal ? $this->tanggal->format('Y') : null;
    }

    
    protected $appends = ['tahun_tanggal'];
}
