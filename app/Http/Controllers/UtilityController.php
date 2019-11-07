<?php

namespace App\Http\Controllers;

use App\Company;
use App\Image;
use Illuminate\Http\Request;
use File;
use Alert;
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
        $title = 'Utilitas';
        return view('admin.company', compact('company','title'));
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

        Alert::success('Perusahaan berhasil diperbarui', 'berhasil');
        return redirect('/company');
    }

    public function homePicture()
    {
        $company = Company::find(1);
        $title = 'Utilitas';

        return view('admin.home-picture', compact('company','title'));
    }

    public function updateHomePicture(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $image = Image::findOrFail($id);
        $image->image = $this->setImageUpload($request->file('image'), 'img/carousel', $image->image);
        $image->save();

        Alert::success('Gambar berhasil diperbarui', 'berhasil');
        return redirect('/home-picture');
    }

    public function addHomePicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $image = new Image;
        $image->company_id = 1;
        $image->image = $this->setImageUpload($request->file('image'), 'img/carousel');
        $image->save();

        Alert::success('Gambar berhasil ditambahkan', 'berhasil');
        return redirect('/home-picture');
    }

    public function destroyHomePicture($id)
    {
        $old_photo = Image::findOrFail($id);
        File::delete(public_path('img/carousel/' . $old_photo->image));
        Image::destroy($id);
        Alert::success('Gambar berhasil dihapus', 'berhasil');
        return redirect('/home-picture');
    }
}
