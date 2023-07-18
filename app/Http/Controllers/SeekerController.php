<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFromRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeekerController extends Controller
{
    const USER_SEEKER = 'seeker';

    public function seekerCreate()
    {
        return view('users.seeker-register');
    }

    public function seekerStore(RegistrationFromRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => self::USER_SEEKER
        ]);

        Auth::login($user); // Log in the newly created user

        $user->sendEmailVerificationNotification();


        return redirect()->route('login.create')->with('successMessage', 'Your account was created.');
    }

    public function showLogin()
    {
        return view('users.Login');
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->only('email', 'password', 'user_type');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->user_type === 'employer') {
                return redirect()->route('show.dashboard');
            } else if (Auth::user()->user_type === 'seeker') {
                return redirect()->route('create.jobs');
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid email or password.'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
