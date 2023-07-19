<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'seeker']);
    }
    public function addFavorite(Listing $post)
    {
        auth()->user()->favorites()->attach($post->id);
        $post->favorite = true;
        $post->save();

        return redirect()->back()->with('successMessage', 'Post added to favorites.');
    }

    public function removeFavorite(Listing $post)
    {
        auth()->user()->favorites()->detach($post->id);
        $post->favorite = false;
        $post->save();

        return redirect()->back()->with('successMessage', 'Favorite removed successfully.');
    }
    public function showFavorite()
    {
        // Get the authenticated user's favorite posts
        $userFavorites = Auth::user()->favorites;

        return view('profile.savePost', compact('userFavorites'));
    }

}
