<?php

namespace App\Http\Controllers;

use App\Type;
use Alert;
use Illuminate\Http\Request;

class TypeController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $category)
    {
        $request->validate([
            'jenis' => 'required'
        ]);

        Type::create([
            'category_id' => $category,
            'type' => $request->jenis
        ]);

        Alert::success('Jenis berhasil ditambahkan', 'berhasil');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $category)
    {
        $request->validate([
            'jenis' => 'required'
        ]);

        Type::where('id', $id)->update(['type' => $request->jenis]);

        Alert::success('Jenis berhasil diperbarui', 'berhasil');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $category)
    {
        Type::destroy($id);
        Alert::success('Jenis berhasil dihapus', 'berhasil');
        return redirect()->back();
    }
}
