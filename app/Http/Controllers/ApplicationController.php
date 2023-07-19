<?php

namespace App\Http\Controllers;
use App\Mail\AcceptedMail;
use App\Mail\RejectMail;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\New_;

class ApplicationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'employ']);
    }
    public function createApplication()
    {
        $listings = Listing::latest()->withCount('users')->where('user_id', auth()->user()->id)->get();
            return view('application.show',compact('listings'));
    }

    public function showApplication(Listing $listing)
    {
        //we make a police to chek if the id == user_id in listing or not
        $this->authorize('view',$listing);
        $listings = Listing::with('users')->where('slug',$listing->slug)->first();

        return view('application.post',compact('listings'));
    }


    public function acceptedApplication($listingID, $userID)
    {
        // Find the listing with the given ID
        $listing = Listing::find($listingID);
        $user = User::find($userID);
        // Check if the listing exists
        if ($listing) {
            // Update the pivot table for the relationship between the listing and user
            $listing->users()->updateExistingPivot($userID, [
                'accepted' => true, // Set 'accepted' column to true
                'reject' => '0' // Set 'reject' column to '0'
            ]);
            Mail::to($user->email)->queue(new AcceptedMail($user->name,$listing->title));

            // Redirect back to the previous page with a success message
            return back()->with('successMessage', 'User accepted successfully');
        }

        // If the listing does not exist, simply redirect back to the previous page
        return back();
    }

    public function rejectApplication($listingID, $userID)
    {
        // Find the listing with the given ID
        $listing = Listing::find($listingID);

        // Check if the listing exists
        if ($listing) {
            // Update the pivot table for the relationship between the listing and user
            $listing->users()->updateExistingPivot($userID, [
                'accepted' => '0', // Set 'accepted' column to '0'
                'reject' => true // Set 'reject' column to true
            ]);
            $user = User::find($userID);
            Mail::to($user->email)->queue(new RejectMail($user->name,$listing->title));
            // Redirect back to the previous page with an error message
            return back()->with('errorMessage', 'User rejected successfully');
        }

        // If the listing does not exist, simply redirect back to the previous page
        return back();
    }


}
