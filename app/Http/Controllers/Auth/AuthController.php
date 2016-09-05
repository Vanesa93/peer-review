<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar) {

        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    //override login with email or username
    public function postLogin(Request $request) {
        $this->validate($request, [
            'login' => 'required', 'password' => 'required',
        ]);
        //check if the login is with username or email
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = $request->input('login');
        if ($this->auth->attempt(array($field => $credentials, 'password' => $request->input('password')), $request->has('remember'))) {
            $user = Auth::user();
            if ($user->account_type == 1) {
                $redirectPath = url('tasks');
            } elseif ($user->account_type == 2) {
                $redirectPath = url('mytasks');
            } elseif ($user->account_type == 0) {
                $redirectPath = url('users');
            }
            return Redirect::to($redirectPath);
        }
        return redirect($this->loginPath())
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'email' => $this->getFailedLoginMessage(),
        ]);
//    
    }

}
