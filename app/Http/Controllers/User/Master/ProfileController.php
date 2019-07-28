<?php

namespace App\Http\Controllers\User\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formUbahPassword(){
        return view('user.master.profile.form_ubah_password');
    }

    public function actionUbahPassword(Request $request){

        $passwordLama = $request->password_lama;
        $passwordBaru = $request->password_baru;
        $konfirmasiPassword = $request->konfirmasi_password;
        $username = Auth::user()->username;
        $password = Auth::user()->password;
        $callback = [];

        $this->validate($request,[
            'password_lama' => 'required',
            'password_baru' => 'required_with:konfirmasi_password|same:konfirmasi_password',
            'konfirmasi_password' => 'required'
        ]);

        // CEK APAKAH PASSWORD LAMA SESUAI DENGAN PASSWORD DI DATABASE
        if(Hash::check($passwordLama, $password)){

            $update = User::where('username', $username)
                        ->update(['password' => bcrypt($passwordBaru) ]);

            $callback['status'] = true;
            $callback['msg'] = "Ubah Password Berhasil";

        }else{
            $callback['status'] = "Tidak Sesuai Dengan DB";
        }



        return response()->json($callback);



    }
}
