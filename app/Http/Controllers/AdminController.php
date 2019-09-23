<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'name' => 'required'
        ]);

        User::where('id', $id)->update([
            'name' => $request->name
        ]);

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
            if ($request->new_password == $request->confirm_password) {
                User::where('id', $id)->update([
                    'password' => Hash::make($request->confirm_password)
                ]);
                return redirect('/my-profile')->with('success', 'Password has been updated');
            } else {
                return redirect('/my-profile')->with('failed', 'Password not match, Password has not been updated');
            }
        } else {
            return redirect('/my-profile')->with('failed', 'Current password not same, Password has not been updated');
        }
    }
}
