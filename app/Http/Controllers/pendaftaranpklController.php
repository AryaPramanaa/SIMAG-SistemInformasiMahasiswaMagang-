<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pendaftaranpklController extends Controller
{
    public function index(){
        return view('pendaftaranPKL.index');
    }
}
