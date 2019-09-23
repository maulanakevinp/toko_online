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

    public function updateCompany(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'whatsapp_number' => 'required',
            'email' => 'required|email',
            'maps' => 'required',
            'testimonial' => 'required',
        ]);

        Company::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'bukalapak' => $request->bukalapak,
            'tokopedia' => $request->tokopedia,
            'olx' => $request->olx,
            'whatsapp' => $request->whatsapp,
            'line' => $request->line,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'maps' => $request->maps,
            'testimonial' => $request->testimonial,
        ]);

        return redirect('/company')->with('success', 'Company has been updated');
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
