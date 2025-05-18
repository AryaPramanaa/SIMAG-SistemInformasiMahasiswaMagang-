<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
   public function authenticate(Request $request){
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)){

            $user = Auth::user();
            session(['role' => $user->role]);
            
            switch ($user->role) {
                case 'perusahaan':
                    return redirect()->route('dashboard', ['username'=>$user->username]);
                    break;
                case 'kaprodi':
                    return redirect()->route('dashboard', ['username'=>$user->username]);
                    break;
                case 'operator':
                    return redirect()->route('dashboard', ['username'=>$user->username]);
                    break;
                case 'pimpinan':
                    return redirect()->route('dashboard', ['username'=>$user->username]);
                    break;
                default:
                    return redirect()->route('dashboard', ['username'=>$user->username]);
                    break;
            }
        }

        return redirect('/entry')->with('error', 'Maaf usernmae atau password anda salah silahkan coba lagi ');
   }

   public function redirect($username){
        $user = User::where('username', $username)->first();
        return view('backend.dashboard.admin', ['name' => $user->username]);
   }    
   

   public function logout(){
        Auth::logout();
        return redirect('/');
   }
}
