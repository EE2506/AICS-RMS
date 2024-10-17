<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
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
        // Determine if the input is an email (user) or username (admin)
        $isEmail = filter_var($this->loginCredential, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            // Authenticate user by email
            if (Auth::attempt(['email' => $this->loginCredential, 'password' => $this->password])) {
                $this->generateOtp(); // Generate OTP for user
            } else {
                session()->flash('error', 'Invalid credentials');
            }
        } else {
            // Authenticate admin by username
            if (Auth::guard('admin')->attempt(['username' => $this->loginCredential, 'password' => $this->password])) {
                return redirect()->route('admin.dashboard');
            } else {
                session()->flash('error', 'Invalid credentials');
            }
        }
    }

    public function generateOtp()
    {
        // Get authenticated user
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'No user authenticated.');
            return;
        }

        // Check if OTP was recently sent
        if (!Session::has('otp_sent') || Session::get('otp_expires_at') < now()) {
            // Generate OTP
            $this->userOtp = sprintf('%06d', random_int(100000, 999999));
            $user->otp = $this->userOtp;
            $user->otp_expires_at = now()->addMinutes(5);
            $user->save();

            // Send OTP to user's email
            Mail::raw("Your code is: {$this->userOtp}", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Verification Required');
            });

            Session::put('otp_sent', true);
            Session::put('otp_expires_at', now()->addMinutes(5));

            $this->isOtpSent = true; // Show OTP modal
        } else {
            session()->flash('error', 'An OTP has already been sent. Please wait before requesting a new one.');
        }
    }

    public function verifyOtp()
    {
        $user = Auth::user();
        $storedOtp = $user->otp;

        if ($this->userInputOtp == $storedOtp && $user->otp_expires_at > now()) {
            $user->otp_verified_at = now();
            $user->save();

            Session::forget('otp_sent');
            Session::forget('otp_expires_at');

            // OTP verified, redirect to user dashboard
            return redirect()->route('user.dashboard');
        } else {
            session()->flash('error', 'Invalid or expired OTP.');
        }
    }

    public function resendOtp()
    {
        $user = Auth::user();

        if (Session::has('otp_expires_at') && Session::get('otp_expires_at') > now()) {
            session()->flash('error', 'An OTP was recently sent. Please wait before requesting a new one.');
        } else {
            $this->generateOtp(); // Resend OTP
        }
    }

    public function closeOtpModal()
    {
        $this->isOtpSent = false; // Close OTP modal
    }

    public function closeModal()
    {
        session()->forget('error'); // Close error modal
    }
}
