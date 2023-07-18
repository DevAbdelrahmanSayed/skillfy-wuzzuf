<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFromRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EmployeController extends Controller
{
    const USER_EMPLOYER = 'employer';

    public function createEmployer()
    {
        return view('users.employer-register');
    }

    public function storeEmployer(RegistrationFromRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::USER_EMPLOYER,
            'user_trial' => now()->addWeek()
        ]);

        Auth::login($user); // Log in the newly created user

        $user->sendEmailVerificationNotification();

        return redirect()->route('login.create')->with('successMessage', 'Your account was created.');
    }

}
