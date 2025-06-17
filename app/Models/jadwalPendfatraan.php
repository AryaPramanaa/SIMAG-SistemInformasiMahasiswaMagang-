<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jadwalPendfatraan extends Model
{
    use HasFactory;
    protected $table = 'jadwalPendaftarans';
    protected $fillable = [
        'prodi_id',
        'tanggal_buka',
        'tanggal_tutup',
        'tahun_akademik',
        'deskripsi',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
