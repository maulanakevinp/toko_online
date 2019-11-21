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
        $subtitle = 'Perusahaan';
        return view('admin.company', compact('company','subtitle','title'));
    }

    public function updateCompany(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan'       => 'required|max:60',
            'deskripsi_perusahaan'  => 'required',
            'alamat'                => 'required',
            'nomor_telepon'         => 'required|digits_between:6,13',
            'nomor_whatsapp'        => 'required|digits_between:6,13',
            'email'                 => 'required|email|max:60',
            'maps'                  => 'required',
            'deskripsi_testimoni'   => 'required',
            'rekening_bca'          => 'nullable|digits_between:6,30',
            'rekening_bni'          => 'nullable|digits_between:6,30',
        ]);

        Company::where('id', $id)->update([
            'name'              => $request->nama_perusahaan,
            'description'       => $request->deskripsi_perusahaan,
            'bukalapak'         => $request->bukalapak,
            'tokopedia'         => $request->tokopedia,
            'olx'               => $request->olx,
            'whatsapp'          => $request->whatsapp,
            'line'              => $request->line,
            'address'           => $request->alamat,
            'phone_number'      => $request->nomor_telepon,
            'whatsapp_number'   => $request->nomor_whatsapp,
            'email'             => $request->email,
            'maps'              => $request->maps,
            'testimonial'       => $request->deskripsi_testimoni,
            'bca'               => $request->rekening_bca,
            'bni'               => $request->rekening_bni,
        ]);

        Alert::success('Perusahaan berhasil diperbarui', 'berhasil');
        return redirect('/company');
    }

    public function homePicture()
    {
        $company = Company::find(1);
        $title = 'Utilitas';
        $subtitle = 'Slideshow';

        return view('admin.home-picture', compact('company','subtitle','title'));
    }

    public function updateHomePicture(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $image = Image::findOrFail($id);
        $image->image = $this->setImageUpload($request->file('foto'), 'img/carousel', $image->image);
        $image->save();

        Alert::success('Gambar berhasil diperbarui', 'berhasil');
        return redirect('/home-picture');
    }

    public function addHomePicture(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $image = new Image;
        $image->company_id = 1;
        $image->image = $this->setImageUpload($request->file('foto'), 'img/carousel');
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
