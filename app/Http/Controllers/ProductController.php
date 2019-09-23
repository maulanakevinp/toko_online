<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Type;
use App\Photo;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $title = 'Products';
        $categories = Category::all();
        $products = Product::paginate(15);
        return view('products.index', [
            'title' => $title,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $categories = Category::all();
        $products = Product::where('name', 'like', '%' . $keyword . '%')->paginate(15);
        $title = 'Products';

        return view('products.index', [
            'title' => $title,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function category($cat)
    {
        $cat = str_replace('-', ' ', $cat);
        $categories = Category::all();
        $category = Category::where('category', $cat)->first();
        $product = new Product;
        $products = $product->category($category->id);
        $types = Type::where('category_id', $category->id)->get();
        $title = $category->category;

        return view('products.category', [
            'title' => $title,
            'types' => $types,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function type($id, $cat)
    {
        $cat = str_replace('-', ' ', $cat);
        $categories = Category::all();
        $category = Category::where('category', $cat)->first();
        $products = Product::where('type_id', $id)->paginate(15);
        $types = Type::where('category_id', $category->id)->get();
        $type = Type::find($id);
        $title = $type->type;

        return view('products.type', [
            'title' => $title,
            'types' => $types,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function getTypes(Request $request)
    {
        $id = $request->id;
        $types = Type::where('category_id', $id)->get();

        echo "<option value=''> Select Type </option>";
        foreach ($types as $type) {
            echo "<option value='" . $type['id'] . "'>" . $type['type'] . "</option>";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = new Product;
        $product = $products->product($id);
        $categories = Category::all();
        $photos = Photo::where('photo1', $product->photo1)->get();
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'photos' => $photos
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateImage($id, $photo)
    {
        # code...
    }

    public function deleteImage($id, $photo)
    {
        # code...
    }
}
