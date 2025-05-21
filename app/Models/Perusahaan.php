<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaans';
    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'kontak',
        'bidang_usaha',
        'status_kerjasama',
        
    ];
    public function pengajuanpkl()
    {
        return $this->hasMany(pengajuanPKL::class );
    }
}
