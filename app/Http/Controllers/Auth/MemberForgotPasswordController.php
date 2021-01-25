<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Jobs\ForgotPasswordJob;
use App\Models\Member;

class MemberForgotPasswordController extends Controller
{

	use SendsPasswordResetEmails;
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
      return view('auth.passwords.email');
    }

    /**
     *
     * @return void
     */
    public function sendResetLinkEmail(Request $r)
    {
        $title = 'Reset Password';

        $r->validate([
            'email' => 'required'
        ]);

        $member = Member::where("email",$r->email)
                          ->orWhere('phone',$r->email)
                          ->first();
        if($member != null)
        {
            if($member->active == 1)
            {
              if((strtotime($member->last_send_active)+180) <= strtotime(date('Y-m-d H:i:s')))
              {
                $member = $member->first();
                $member->remember_token = bcrypt(date('Ymdhis').'your_key');
                $member->last_send_active = date('Y-m-d H:i:s');
                $member->save();

                $job = (new ForgotPasswordJob($member));
                dispatch($job);
                return view('auth.passwords.send_forgot',compact('title','member','r'));

              }else{

                return view('auth.passwords.send_forgot_failed',compact('title','member','r'));

              }

            }else{
              flash('Akun anda belum aktif, silahkan aktivasi via email atau <a href="'.route('activation.resend').'" class="text-primary">Kirim ulang kode</a> terlebih dahulu')->error();
              return redirect()->back();
            }
        }else{
            flash('Email atau Nomor telepon anda tidak terdaftar')->error();
            return redirect()->back();
        }
    }
}
