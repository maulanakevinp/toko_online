<?php

namespace App\Http\Controllers;

use App\Type;
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
            'type' => 'required'
        ]);

        Type::create([
            'category_id' => $category,
            'type' => $request->type
        ]);

        return redirect('/categories' . '/' . $category . '/edit')->with('success', 'Type has been created');
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
            'type' => 'required'
        ]);

        Type::where('id', $id)->update([
            'type' => $request->type
        ]);

        return redirect('/categories' . '/' . $category . '/edit')->with('success', 'Type has been updated');
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
        return redirect('/categories' . '/' . $category . '/edit')->with('success', 'Type has been deleted');
    }
}
