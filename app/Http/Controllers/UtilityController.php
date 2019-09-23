<?php

namespace App\Http\Controllers;

use App\Company;
use App\Photo;
use Illuminate\Http\Request;

class UtilityController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function company()
    {
        $company = Company::find(1);
        return view('admin.company', ['company' => $company]);
    }

    public function updateCompany(Request $request)
    {
        # code...
    }

    public function homePicture()
    {
        $company = Company::find(1);

        $photos = Photo::where('photo1', $company->photo1)->get();

        return view('admin.home-picture', ['photos' => $photos, 'company' => $company]);
    }

    public function updateHomePicture(Request $request)
    {
        # code...
    }
}
