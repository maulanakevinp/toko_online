<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use File;

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
        return view('admin.dashboard');
    }

    public function show()
    {
        return view('admin.show');
    }

    public function editProfile()
    {
        return view('admin.edit-profile');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        $file = $request->file('image');

        if (!empty($file)) {
            $file_name = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img/profile'), $file_name);
            File::delete(public_path('img/profile/' . $user->photo));
            User::where('id', $id)->update([
                'name' => $request->name,
                'photo' => $file_name
            ]);
        } else {
            User::where('id', $id)->update([
                'name' => $request->name
            ]);
        }

        return redirect('/my-profile')->with('success', 'Profile has been updated');
    }

    public function editPassword()
    {
        return view('admin.edit-password');
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
                return redirect('/my-profile')->with('failed', 'Password has not been updated');
            } else {
                if ($request->new_password == $request->confirm_password) {
                    User::where('id', $id)->update([
                        'password' => Hash::make($request->confirm_password)
                    ]);
                    return redirect('/my-profile')->with('success', 'Password has been updated');
                } else {
                    return redirect('/my-profile')->with('failed', 'Password not match, Password has not been updated');
                }
            }
        } else {
            return redirect('/my-profile')->with('failed', 'Current password not same, Password has not been updated');
        }
    }
}
