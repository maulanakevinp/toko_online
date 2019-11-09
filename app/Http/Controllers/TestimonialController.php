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
        $subtitle = 'Testimonial';
        $testimonials = Testimonial::all();
        return view('testimonials.index', compact('title','subtitle','testimonials'));
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
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);

        $testimonial = new Testimonial;
        $testimonial->name = $request->nama;
        $testimonial->description = $request->deskripsi;
        $testimonial->photo = $this->setImageUpload($request->file('foto'), 'img/testimonial');
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
        $subtitle = 'Testimonial';
        $testimonial = Testimonial::find($id);
        return view('testimonials.edit', compact('title','subtitle','testimonial'));
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
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,gif,webp|max:2048'
        ]);


        if ($request->file('foto')) {
            $testimonial->photo = $this->setImageUpload($request->file('foto'),'img/testimonial',$testimonial->photo);
        }
        
        $testimonial->name = $request->nama;
        $testimonial->description = $request->deskripsi;
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
