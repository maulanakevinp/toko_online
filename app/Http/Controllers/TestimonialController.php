<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use File;
use Alert;

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
        $title = 'Utilitas';
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('title','testimonials'));
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
            'photo' => 'required|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);

        $testimonial = new Testimonial;
        $testimonial->name = $request->name;
        $testimonial->description = $request->description;
        $testimonial->photo = $this->setImageUpload($request->file('photo'), 'img/testimonial');
        $testimonial->save();

        Alert::success('Testimoni berhasil ditambahkan', 'berhasil');
        return redirect('/testimonials');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Utilitas';
        $testimonial = Testimonial::find($id);
        return view('testimonials.edit', compact('title','testimonial'));
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
            'photo' => 'image|mimes:jpeg,png,gif,webp|max:2048'
        ]);


        if ($request->file('photo')) {
            $testimonial->photo = $this->setImageUpload($request->file('photo'),'img/testimonial',$testimonial->photo);
        }
        
        $testimonial->name = $request->name;
        $testimonial->description = $request->description;
        $testimonial->save();

        Alert::success('Testimoni berhasil diperbarui', 'berhasil');
        return redirect('/testimonials');
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

        Alert::success('Testimoni berhasil dihapus', 'berhasil');
        return redirect('/testimonials');
    }
}
