<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembimbingIndustri extends Model
{
    use HasFactory;
    protected $table = 'pembimbingIndustris';
    protected $fillable = [
        'nama_pembimbing',
        'jabatan',
        'kontak',
        'email',
        'perusahaan_id',
    ];
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
