<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function company()
    {
        return view('admin.company');
    }

    public function updateCompany(Request $request)
    {
        # code...
    }

    public function homePicture()
    {
        return view('admin.home-picture');
    }

    public function updateHomePicture(Request $request)
    {
        # code...
    }
}
