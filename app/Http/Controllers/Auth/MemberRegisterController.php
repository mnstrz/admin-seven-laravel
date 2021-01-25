<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

use App\Jobs\RegisterEmailJob;
use App\Models\Newsletter;

class MemberRegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function showRegistrationForm()
    {
        return view('public.register');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required|string|max:255|unique:member,phone',
            'email' => 'required|string|email|max:255|unique:member,email',
            'password' => 'required|string|min:8|confirmed',
            'agree' => 'required'
        ],[
            'agree.required' => 'Wajib mematuhi kebijakan dan privasi',
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Member
     */
    protected function create(array $data)
    {
        $activation_code = bcrypt(date('Ymdhis').'your_key');
        return Member::create([
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activation_code' => $activation_code,
            'active' => 0,
            'last_send_active' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($request->has('newsletter'))
        {
            $newsletter = new Newsletter;
            $newsletter->email = $request->email;
            $newsletter->save();
        }

        $job = (new RegisterEmailJob($user));
        dispatch($job);

        return view('public.registered', compact('user','request'));
    }

    /**
     * @method activate
     * @param Request .... $r
     * @return void
     */
    public function activation(Request $r)
    {
        $title = "Activation";
        
        if($r->has('email') && $r->has('token'))
        {
            $member = Member::where('email',$r->email);
            if($member->first()->active != 1)
            {
                $member = $member->where('activation_code', $r->token);
                if($member->count() > 0)
                {
                    $member = $member->first();
                    $member->activation_code = bcrypt(date('Ymdhis').'your_key');
                    $member->active = 1;
                    $member->save();

                    return view('auth.activated', compact('title','member','r'));
                }else{
                    return view('auth.not_activated', compact('title','r'));
                }
            }else{
                flash('Akun anda telah aktif !')->success();
                return redirect()->route('login');
            }
        }else{
            return view('auth.not_activated', compact('title','r'));
        }

    }

    /**
     * @method resendActivation
     * @return void
     */

    public function resendActivation()
    {
        $title = 'Resend Activation';
        return view('auth.resend_activation',compact('title'));
    }

    /**
     * @method sendActivation
     * @return void
     * @param Request ... $r
     */

    public function sendActivation(Request $r)
    {
        $title = 'Send Activation';

        $r->validate([
            'email' => 'required'
        ]);

        $member = Member::where("email",$r->email)->orWhere('phone',$r->email)->first();
        if($member != null)
        {
            $member = $member->first();

            if($member->active == 0)
            {
                if((strtotime($member->last_send_active)+180) <= strtotime(date('Y-m-d H:i:s')))
                {
                    $member->activation_code = bcrypt(date('Ymdhis').'your_key');
                    $member->last_send_active = date('Y-m-d H:i:s');
                    $member->save();

                    $job = (new RegisterEmailJob($member));
                    dispatch($job);

                    return view('auth.resend_activation_success',compact('title','member','r'));

                }else{

                    return view('auth.resend_activation_error',compact('title','member','r'));

                }
            }else{
                flash('Akun anda telah aktif!')->success();
                return redirect()->route('login');
            }
        }else{
            flash('Email atau Nomor Telepon Anda  Anda tidak terdaftar')->error();
            return redirect()->back();
        }
    }



    /**
     * @method resendActivationQuick
     * @return void
     * @param Request ... $r
     */

    public function resendActivationQuick(Request $r)
    {
        $title = 'Send Activation';

        $r->validate([
            'email' => 'required'
        ]);

        $member = Member::where("email",$r->email)->orWhere('phone',$r->email)->first();
        if($member != null)
        {
            $member = $member->first();

            if($member->active == 0)
            {
                if((strtotime($member->last_send_active)+180) <= strtotime(date('Y-m-d H:i:s')))
                {
                    $member->activation_code = bcrypt(date('Ymdhis').'your_key');
                    $member->last_send_active = date('Y-m-d H:i:s');
                    $member->save();

                    $job = (new RegisterEmailJob($member));
                    dispatch($job);

                    return view('auth.resend_activation_success',compact('title','member','r'));

                }else{

                    return view('auth.resend_activation_error',compact('title','member','r'));

                }
            }else{
                flash('Akun Anda Sudah Aktif')->success();
                return redirect()->route('login');
            }
        }else{
            flash('Email atau Nomor Telepon Anda tidak terdaftar')->error();
            return redirect()->route('register');
        }
    }
}
