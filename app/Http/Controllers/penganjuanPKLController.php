<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\pengajuanPKL;
use Illuminate\Http\Request;

class penganjuanPKLController extends Controller
{
    public function index(){
        
        $mahasiswas = pengajuanPKL::latest()->paginate(5);
        return view('backend.mahasiswa.pengajuanPKL.index',['mahasiswas'=>$mahasiswas]);
    }

    public function destroy(string $id){
        pengajuanPKL::destroy($id);
        return redirect('backend.mahasiswa.pengajuanPKL.index');
    }

    public function create()
    {
        $mahasiswas = pengajuanPKL::all();   
        return view('backend.mahasiswa.pengajuanPKL.create',compact('mahasiswas'));
    }

    
}
