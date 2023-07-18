<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoplistingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','seeker']);
    }

    public function createJobs(Request $request){
       $salary = $request->query('sort');
        $date = $request->query('date');
        $jop_type = $request->query('jop_type');
        $listings = Listing::query();
        if($salary === 'high_to_low'){
            $listings->orderBy('salary','desc');
        } else if($salary === 'low_to_high'){
            $listings->orderBy('salary','asc');
        }
        if($date === 'latest'){
            $listings->orderBy('created_at','desc');
        } else if($salary === 'low_to_high'){
            $listings->orderBy('created_at','asc');
        }
        if($jop_type === 'fulltime'){
            $listings->where('job_type','Fulltime');
        } else if($jop_type === 'parttime'){
            $listings->where('job_type','Parttime ');
        } else if($jop_type === 'Casual'){
            $listings->where('job_type','Casual');
        }else if($jop_type === 'Contract'){
            $listings->where('job_type','Contract ');
        }
        // Use paginate() instead of get()
        // Use paginate() instead of get()
        $jobs = $listings->with('user_posts')->simplePaginate(4); // Replace '10' with the number of results you want per page.

        return view('jop.home', compact('jobs'));
    }

    public function showJobs(Listing  $listing){
        return view('jop.post',compact('listing'));
    }
    public function updateJobsResume(Request $request){
        if($request->hasFile('resume'))
        {
           $resume =  $request->file('resume')->store('resume','public');
           $user = User::where('id',auth()->user()->id)->update([
               'resume'=>$resume
           ]);

           return back()->with('successMessage','Your resume has been updated successfully');
        }
        return back()->with('errorMessage','Your resume has not uploaded');
    }
    public function submitJobsResume($listingID)
    {
        // Get the current authenticated user
        $user = auth()->user();
        if ($user->listings->contains('id', $listingID)) {
            return redirect()->back()->with('errorMessage', 'You have already applied for this job.');
        }
        // Sync the listing ID with the user's listings relationship
        $user->listings()->syncWithoutDetaching([$listingID]);

        return redirect('home/jobs')->with('successMessage', 'Your application was successfully submitted');
    }

}
