<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'employ'])->except('verify', 'resend');
    }

    public function showDashboard()
    {
        return view('users.dashboard');
    }

    public function verify()
    {
        return view('users.verified');
    }

    public function resend()
    {
        $user = Auth::user();
        if ($user->hasVerifiedEmail()) {
            $user = Auth::user();
            if ($user->user_type === 'seeker') {
                return redirect('/home/jobs')->with('successMessage', 'Your email is already verified.');
            } else if ($user->user_type === 'employer') {
                return redirect('/dashboard')->with('successMessage', 'Your email is already verified.');
            }
        }
        $user->sendEmailVerificationNotification();
        return back()->with('successMessage', 'Verification link has been sent successfully.');
    }
}

