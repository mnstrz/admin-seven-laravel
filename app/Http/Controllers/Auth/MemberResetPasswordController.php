<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\Models\Member;

class MemberResetPasswordController extends Controller
{
    //
    use ResetsPasswords;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * @method showResetForm
     * @param Request $r
     * @return void
     */
    public function showResetForm(Request $r)
    {
        $title = "Reset Password";
        
        if($r->has('email') && $r->has('token'))
        {
            $member = Member::where('remember_token', $r->token)
                            ->where('email',$r->email);
            if($member->count() > 0)
            {
                $member = $member->first();
                $member->save();

                return view('auth.passwords.reset', compact('title','member','r'));
            }else{
                return view('auth.passwords.reset_failed', compact('title'));
            }
        }else{
            return view('auth.passwords.reset_failed', compact('title'));
        }
    }

    /**
     * @method reset
     * @return void
     * @param Request $r
     */
    public function reset(Request $r)
    {
        $title = "Reset Password";

        $r->validate([
            'email' => 'required',
            'token' => 'required',
            'password' => 'required|min:8|confirmed|string'
        ],
        [
            'password.min' => 'Password minimal 8 Karakter'
        ]);

        if($r->has('email') && $r->has('token'))
        {
            $member = Member::where('remember_token', $r->token)
                            ->where('email',$r->email);
            if($member->count() > 0)
            {
                $member = $member->first();
                $member->password = bcrypt($r->password);
                $member->remember_token = bcrypt(date('Ymdhis').'your_key');
                $member->save();

                return view('auth.passwords.reset_success', compact('title','member','r'));
            }else{
                return view('auth.passwords.reset_failed', compact('title'));
            }
        }else{
            return view('auth.passwords.reset_failed', compact('title'));
        }

    }
}
