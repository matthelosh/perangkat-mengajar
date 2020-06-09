<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {
            return redirect('home');
        } else {
            return back()->with(['status' => 'error', 'msg' => 'Cek Kembali Usernam / Password']);
        }
    }
  public function logout(Request $request)
  {

   Auth::logout();



    return redirect('/')->with(['status' => 'sukses', 'msg' => 'Anda telah keluar sistem']);
  }
}
