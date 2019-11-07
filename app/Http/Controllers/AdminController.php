<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use File;
use Alert;

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
        return view('admin.dashboard', compact('title'));
    }

    public function show()
    {
        $title = 'Profil';
        return view('admin.show',compact('title'));
    }

    public function editProfile()
    {
        $title = 'Profil';
        return view('admin.edit-profile',compact('title'));
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
        return view('admin.edit-password',compact('title'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ]);

        $user = User::find($id);

        if (Hash::check($request->current_password, $user->password)) {
            if (($request->new_password == $request->current_password)) {
                Alert::warning('tidak ada perubahan')->persistent('tutup');
                return back();
            } else {
                User::where('id', $id)->update([
                    'password' => Hash::make($request->confirm_password)
                ]);
                Alert::success('Password berhasil diperbarui', 'berhasil');
                return redirect('/my-profile');
            }
        } else {
            Alert::error('Password lama salah, password gagal diperbarui', 'gagal')->persistent('tutup');
            return back();
        }
    }
}
