<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Login as LoginEvent;
use Livewire\Component;

class Login extends Component
{
    public $loginCredential, $password, $sessionKey, $otp, $isOtpSent = false, $userOtp, $userInputOtp;

    public function render()
    {
        return view('livewire.user.login')->layout('layouts.user-login');
    }

    public function login()
    {
        $isEmail = filter_var($this->loginCredential, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            if (Auth::attempt(['email' => $this->loginCredential, 'password' => $this->password])) {
                event(new LoginEvent('web', Auth::user(), false));

                $this->authenticated(Auth::user());
                $this->generateOtp();
            } else {
                session()->flash('error', 'Invalid credentials');
            }
        } else {
            if (Auth::guard('admin')->attempt(['username' => $this->loginCredential, 'password' => $this->password])) {
                event(new LoginEvent('admin', Auth::guard('admin')->user(), false));

                return redirect()->route('admin.dashboard');
            } else {
                session()->flash('error', 'Invalid credentials');
            }
        }
    }

    public function generateOtp()
    {
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'No user authenticated.');
            return;
        }

        if (!Session::has('otp_sent') || now()->greaterThan(Session::get('otp_expires_at'))) {
            $this->userOtp = sprintf('%06d', random_int(100000, 999999));
            $user->otp = $this->userOtp;
            $user->otp_expires_at = now()->addMinutes(5);
            $user->save();

            Mail::raw("Your code is: {$this->userOtp}", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Verification Required');
            });

            Session::put('otp_sent', true);
            Session::put('otp_expires_at', now()->addMinutes(5));

            $this->isOtpSent = true;
        } else {
            session()->flash('error', 'An OTP has already been sent. Please wait before requesting a new one.');
        }
    }

    public function verifyOtp()
    {
        $user = Auth::user();

        if ($this->userInputOtp == $user->otp && Carbon::parse($user->otp_expires_at)->isFuture()) {
            $user->update(['otp_verified_at' => now()]);

            Session::forget('otp_sent');
            Session::forget('otp_expires_at');

            return redirect()->route('user.dashboard');
        } else {
            session()->flash('error', 'Invalid or expired OTP.');
        }
    }

    public function resendOtp()
    {
        $user = Auth::user();

        if (Session::has('otp_expires_at') && now()->lessThan(Session::get('otp_expires_at'))) {
            session()->flash('error', 'An OTP was recently sent. Please wait before requesting a new one.');
        } else {
            $this->generateOtp();
        }
    }

    public function closeOtpModal()
    {
        $this->isOtpSent = false;
    }

    public function closeModal()
    {
        session()->forget('error');
    }

    private function authenticated(User $user)
    {
        $this->logActivity($user, 'Login', 'User logged in');
        $user->update(['last_active' => now()]);
    }

    private function logActivity(User $user, $activityType, $description)
    {
        UserActivityLog::create([
            'user_id' => $user->id,
            'activity_type' => $activityType,
            'description' => $description,
        ]);
    }

    public function showLogs()
{
    $logs = UserActivityLog::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
    return view('livewire.user.logs', compact('logs'));
}

}
