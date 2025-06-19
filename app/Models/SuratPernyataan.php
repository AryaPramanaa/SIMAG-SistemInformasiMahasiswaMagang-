<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratPernyataan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'suratPernyataans';
    protected $fillable = [
        'perusahaan_id',
        'nomor_surat',
        'tanggal_surat',
        'file_path',
        'jenis_surat',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
