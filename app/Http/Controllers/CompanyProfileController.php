<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified','seeker']);
    }
    public function showCompany($id)
    {
        $profileCompany = User::with('companys')->where('id',$id)->where('user_type','employer')->first();
        return view('profile.company',get_defined_vars());
    }

}
