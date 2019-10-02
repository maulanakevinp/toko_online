<?php

namespace App\Http\Controllers;

use App\Company;
use App\Photo;
use Illuminate\Http\Request;
use File;

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

        $photo = Photo::where('photo1', $company->photo1)->first();

        return view('admin.home-picture', ['photo' => $photo, 'company' => $company]);
    }

    public function updateHomePicture(Request $request, $id, $photo)
    {
        $old_photo = Photo::where('photo1', $id)->first();

        $file = $request->file($photo);

        if (!empty($old_photo->$photo)) {
            File::delete(public_path('img/carousel/' . $old_photo->$photo));
        }

        $file_name = time() . "_" . $file->getClientOriginalName();

        $file->move(public_path('img/carousel'), $file_name);

        Photo::where('photo1', $id)->update([
            $photo => $file_name
        ]);

        return redirect('/home-picture')->with('success', 'Photo has been updated');
    }

    public function destroyHomePicture($id, $photo)
    {
        $old_photo = Photo::where('photo1', $id)->first();
        File::delete(public_path('img/carousel/' . $old_photo->$photo));

        Photo::where('photo1', $id)->update([
            $photo => null
        ]);

        return redirect('/home-picture')->with('success', 'Photo has been deleted');
    }
}
