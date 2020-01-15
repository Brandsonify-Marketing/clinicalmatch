<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\VerifyUser;
use App\Mail\VerifyMail;

class VerificationController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Email Verification Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling email verification for any
      | user that recently registered with the application. Emails may also
      | be re-sent if the user didn't receive the original email message.
      |
     */

use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function index() {
        return view('auth.verify-email');
    }

    public function sendEmail() {
        $user = Auth::user();
        VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time()),
        ]);
        if($user->verified == '0' || is_null($user->verified))
        {
             Mail::to($user->email)->send(new VerifyMail($user));
        }
        return back();
    }

    public function verifyEmail($token) {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified.";
            } else {
                $status = "Your e-mail is already verified.";
            }
        } else {
            return redirect()->route('verify-email')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect()->route('verify-email')->with('status', $status);
    }

}
