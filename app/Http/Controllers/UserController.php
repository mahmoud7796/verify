<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\User;
use App\Users_Verified;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function store(Request $request){
        if(Auth::attempt(['email' => $request -> email, 'password' => $request -> password])){
            if(Auth::user()->email_verified_at == null){
                Auth::logout();
              //   $user = User::select('email')->get();
              //  Mail::to($user[0]['email'])-> send(new VerifyEmail($user));
                return redirect()-> route('user.login')-> with(['error' => 'please verified your mail to login']);
            }
            return redirect()-> route('dashboard')-> with(['success' => 'login Succefully']);
        }else {
            return redirect()-> route('user.login')-> with(['error' => 'wrong email or password']);
        }

    }


    public function register(){
        return view('auth.register');
    }

    public function registerStore(Request $request){
        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => bcrypt($request -> password),
        ]);

        Users_Verified::create([
           'token' => Str::random(60),
            'user_id' => $user -> id,
        ]);
        Mail::to($user -> email)-> send(new VerifyEmail($user));
        return redirect()-> route('user.login')-> with(['success' => 'verified your mail to login']);
       // return view('emails.resendEmail');
    }

    public function verifyEmail($token){
        $verifiedUser = Users_Verified::where('token',$token)-> first();
        if(isset($verifiedUser)){
            $user = $verifiedUser -> users;
            if(!$user -> email_verified_at){
                $user -> email_verified_at = Carbon::now();
                $user -> save();
                return redirect()-> route('user.login')-> with(['success' => 'your mail has been verified']);

            }else{
                return redirect()->back()-> with(['success' => 'your mail already has been verified']);
            }

        }else{
            return redirect()->back()-> with(['error' => 'something error please try again']);

        }


    }

/*    protected function resend(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        $user->verifyToken = Str::random(40);
        $user->save();

        $this->sendEmail($user);

        return $user;
    }*/


}
