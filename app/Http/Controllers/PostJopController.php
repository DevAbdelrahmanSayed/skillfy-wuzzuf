<?php

namespace App\Http\Controllers;

use App\Http\Requests\JopPostRequest;
use Illuminate\Http\Request;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Str;
class PostJopController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','employ','premium']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $get_post= Listing::where('user_id',auth()->user()->id)->get();
        return view('jop.index',compact('get_post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imagePath = $request->file('feature_photo')->store('images','public');

        $post = Listing::create([
            'feature_photo' => $imagePath,
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'roles' => $request->roles,
            'job_type' => $request->job_type,
            'address' => $request->address,
            'salary' => $request->salary,
            'slug' => Str::slug($request->title) . '.' . Str::uuid(),
            'application_close_date' => Carbon::createFromFormat('d/m/Y', $request->application_close_date)->format('Y-m-d'),
        ]);

        return redirect()->route('show.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Listing::find($id);

        if (!$post) {
            abort(404); // Handle the case when the post with the given ID is not found
        }

        return view('jop.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JopPostRequest $request, string $id)
    {
        if($request->hasFile('feature_photo')){
            $imagePath = $request->file('feature_photo')->store('images','public');
            Listing::find($id)->update(['feature_photo'=>$imagePath]);
        }
        Listing::find($id)->update($request->except('feature_photo'));
        return back()->with('successMessage','your jop post has been updated ');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Listing::find($id)->delete();
        return back()->with('errorMessage','your jop post has been delete ');

    }
}
