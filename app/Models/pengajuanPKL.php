<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuanPKL extends Model
{
    use HasFactory;
    protected $table = 'pengajuanPKLs';
    protected $fillable = [
        'mahasiswa_id',
        'perusahaan_id',
        'tanggal_pengajuan',
        'surat_pengantar_path',
        'durasi_pkl',
        'alasan_penolakan',
        'status',
        'divisi_pilihan',

    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class );
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class );
    }
    
}
