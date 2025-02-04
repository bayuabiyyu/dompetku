<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Import Manual Bukan Default
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout', 'logoutAdmin']);
    }

    public function showLoginForm(){
        return view('authAdmin.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //Credential Mencoba Login
        if(Auth::guard('admin')->attempt($credential, $request->member)){
            //Jika Login Berhasil
            return redirect()->intended(route('admin.home'));
        }

        //Jika Tidak Sukses Login
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

}
