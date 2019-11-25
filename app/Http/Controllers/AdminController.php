<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use File;
use Alert;
use App\Order;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $orderEntry = Order::whereVerify(null)->where('image','!=',null)->count();
        $orderProcessed = Order::whereVerify(1)->whereStatus(2)->count();
        $orderFinished = Order::whereStatus(1)->count();
        return view('admin.dashboard', compact('title','orderEntry','orderProcessed','orderFinished'));
    }

    public function show()
    {
        $title = 'Profil';
        $subtitle = 'Profil Saya';
        return view('admin.show',compact('title','subtitle'));
    }

    public function editProfile()
    {
        $title = 'Profil';
        $subtitle = 'Ubah Profil';
        return view('admin.edit-profile',compact('title','subtitle'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        if ($request->file('image')) {
            $user->photo = $this->setImageUpload($request->file('image'),'img/profile',$user->photo);
        }

        $user->name = $request->name;
        $user->save();

        Alert::success('Profil berhasil diperbarui', 'berhasil');
        return redirect('/my-profile');
    }

    public function editPassword()
    {
        $title = 'Profil';
        $subtitle = 'Ganti Password';
        return view('admin.edit-password',compact('title','subtitle'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password_saat_ini' => 'required|min:6',
            'password_baru' => 'required|min:6|required_with:konfirmasi_password|same:konfirmasi_password',
            'konfirmasi_password' => 'required|min:6'
        ]);

        $user = User::find($id);

        if (Hash::check($request->password_saat_ini, $user->password)) {
            if (($request->password_baru == $request->password_saat_ini)) {
                Alert::warning('tidak ada perubahan')->persistent('tutup');
                return back();
            } else {
                User::where('id', $id)->update([
                    'password' => Hash::make($request->konfirmasi_password)
                ]);
                Alert::success('Password berhasil diperbarui', 'berhasil');
                return redirect('/my-profile');
            }
        } else {
            Alert::error('Password saat ini salah, password gagal diperbarui', 'gagal')->persistent('tutup');
            return back();
        }
    }
}
