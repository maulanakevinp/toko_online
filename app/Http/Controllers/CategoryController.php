<?php

namespace App\Http\Controllers;

use App\Category;
use App\Type;
use Illuminate\Http\Request;
use File;

class CategoryController extends Controller
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
        $categories = Category::paginate(15);
        return view('categories.index', compact('categories'));
    }

    public function getType(Request $request)
    {
        $id = $request->id;
        $types = Type::find($id);
        echo json_encode($types);
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
            'category' => 'required',
            'photo' => 'required',
        ]);

        $file = $request->file('photo');
        $file_name = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('img/categories'), $file_name);

        Category::create([
            'category' => $request->category,
            'photo' => $file_name
        ]);

        return redirect('/categories')->with('success', 'Category has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $types = Type::where('category_id', $id)->get();
        return view('categories.edit', [
            'category' => $category,
            'types' => $types
        ]);
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
        $category = Category::find($id);

        $request->validate([
            'category' => 'required',
        ]);

        $file = $request->file('photo');

        if (!empty($file)) {
            $file_name = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('img/categories'), $file_name);
            File::delete(public_path('img/categories/' . $category->photo));

            Category::where('id', $id)->update([
                'category' => $request->category,
                'photo' => $file_name
            ]);
        } else {
            Category::where('id', $id)->update([
                'category' => $request->category,
            ]);
        }

        return redirect('/categories' . '/' . $id . '/edit')->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        File::delete(public_path('img/categories/' . $category->photo));
        Category::destroy($id);

        return redirect('/categories')->with('success', 'Category has been deleted');
    }
}
