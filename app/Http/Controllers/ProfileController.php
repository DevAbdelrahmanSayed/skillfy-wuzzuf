<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('seeker')->except(['createProfile','updateProfile','updatePassword','updateResume']);
        $this->middleware('employ')->except(['seekerProfile','updateProfile','updatePassword','updateResume','showApplied']);
    }

    // Display the profile creation form
    public function createProfile()
    {
        return view('profile.index');
    }

    // Display the seeker profile view
    public function seekerProfile()
    {
        return view('profile.seeker');
    }

    // Update the user's profile
    public function updateProfile(Request $request)
    {
        if ($request->hasFile('profile_pic')) {
            $oldImagePath = auth()->user()->profile_pic;

            // Delete the old profile photo if it exists
            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }

            $imagePath = $request->file('profile_pic')->store('profile', 'public');
            User::find(auth()->user()->id)->update(['profile_pic' => $imagePath]);
        }

        // Update user information excluding the profile picture
        User::find(auth()->user()->id)->update($request->except('profile_pic'));

        return back()->with('successMessage', 'Your profile has been updated');
    }

    // Update the user's resume
    public function updateResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx',
        ]);

        if ($request->hasFile('resume')) {
            $oldResumePath = auth()->user()->resume;

            // Delete the old resume file if it exists
            if ($oldResumePath && Storage::disk('public')->exists($oldResumePath)) {
                Storage::disk('public')->delete($oldResumePath);
            }
            // Store the new resume file
            $file = $request->file('resume');
            $extension = $file->getClientOriginalExtension();
            $newResumeName = 'resume_' . auth()->user()->id . '.' . $extension;
            $resumePath = $file->storeAs('resume', $newResumeName, 'public');
            User::find(auth()->user()->id)->update(['resume' => $resumePath]);

            return back()->with('successMessage', 'Your resume has been updated successfully');
        }
    }

    // Update the user's password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();

        // Check if the current password provided matches the user's actual password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('errorMessage', 'Current password is incorrect');
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('successMessage', 'Your password has been updated successfully');
    }
    public function showApplied()
    {
        $users = User::with('listings')->where('id',auth()->user()->id)->get();
        return view('profile.usersProfile',compact('users'));
    }
}
