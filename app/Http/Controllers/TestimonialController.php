<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use File;

class TestimonialController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048',
        ]);

        $file = $request->file('photo');
        $file_name = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('img/testimonial'), $file_name);

        Testimonial::create([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $file_name
        ]);

        return redirect('/testimonials')->with('success', 'Testimonial has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png,bmp|max:2048'
        ]);

        $file = $request->file('photo');

        if (!empty($file)) {
            $file_name = time() . "_" . $file->getClientOriginalName();
            File::delete(public_path('img/testimonial/' . $testimonial->photo));
            $file->move(public_path('img/testimonial'), $file_name);

            Testimonial::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'photo' => $file_name
            ]);
        } else {
            Testimonial::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        }

        return redirect('/testimonials')->with('success', 'Testimonial has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        File::delete(public_path('img/testimonial/' . $testimonial->photo));
        Testimonial::destroy($id);

        return redirect('/testimonials')->with('success', 'Testimonial has been deleted');
    }
}
