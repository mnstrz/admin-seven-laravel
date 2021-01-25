<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class MemberController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('public.login');
    }

    public function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {
        $username = $this->username();
        $rules = [
                    $username => 'required|string|exists:member'
                ];
        $messages = [
                    $username.'.exists' => 'Email atau Nomor Telepon tidak terdaftar'
                ];
        $this->validate($request,$rules,$messages);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        flash('Anda Telah Keluar')->error();
        return redirect('/');
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'),['active'=>1]);
    }

    public function authenticated($request, $user)
    {
        flash('Hi, Selamat datang kembali')->success();
        return redirect($this->redirectTo);
    }


    protected function guard()
    {
        return \Auth::guard('member');
    }

    public function findUsername()
    {
        $login = request()->input('username');
 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
 
        request()->merge([$fieldType => $login]);
 
        return $fieldType;
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        $maxLoginAttempts = 5;
     
        $lockoutTime = 1; // Dalam menit
     
        return $this->limiter()->tooManyAttempts(
           $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }

}
