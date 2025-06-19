<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembimbingIndustri extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pembimbingIndustris';
    protected $fillable = [
        'perusahaan_id',
        'nama_pembimbing',
        'jabatan',
        'email',
        'kontak',
    ];
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
