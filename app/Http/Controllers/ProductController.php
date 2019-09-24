<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Type;
use App\Photo;
use Illuminate\Http\Request;
use File;

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
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'type' => 'required',
            'description' => 'required',
            'photo1' => 'required',
        ]);

        $data_photo = array();
        for ($i = 1; $i <= 6; $i++) {
            $photo = 'photo' . $i;
            $file = $request->file($photo);
            if (!empty($request->$photo)) {
                $file_name = time() . "_" . $file->getClientOriginalName();
                $file->move('img/products', $file_name);
                $data_photo['photo' . $i] = $file_name;
            } else {
                $data_photo['photo' . $i] = null;
            }
        }

        Photo::create([
            'photo1' => $data_photo['photo1'],
            'photo2' => $data_photo['photo2'],
            'photo3' => $data_photo['photo3'],
            'photo4' => $data_photo['photo4'],
            'photo5' => $data_photo['photo5'],
            'photo6' => $data_photo['photo6'],
        ]);

        Product::create([
            'name' => $request->name,
            'type_id' => $request->type,
            'photo1' => $data_photo['photo1'],
            'price' => $request->price,
            'bukalapak' => $request->bukalapak,
            'tokopedia' => $request->price,
            'olx' => $request->olx,
            'description' => $request->description,
        ]);

        return redirect('/products')->with('success', 'Products has been created');
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
        $photo = Photo::where('photo1', $product->photo1)->first();
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'photo' => $photo
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
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        Product::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'description' => $request->description,
            'type_id' => $request->type,
            'price' => $request->price,
        ]);

        return redirect('/products' . '/' . $id . '/edit')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $photo1 = $product->photo1;
        $photo = Photo::where('photo1', $photo1)->first();
        for ($i = 2; $i <= 6; $i++) {
            $p = 'photo' . $i;
            if (!empty($photo->$p)) {
                File::delete('img/products/' . $photo->$p);
            }
        }
        File::delete('img/products/' . $photo1);

        Product::destroy($id);
        Photo::where('photo1', $photo1)->delete();
        return redirect('/products')->with('success', 'Product has been deleted');
    }

    public function updatePicture(Request $request, $id, $photo)
    {
        $request->validate([
            $photo => 'required'
        ]);

        $product = Product::find($id);
        $old_photo = Photo::where('photo1', $product->photo1)->first();

        $file = $request->file($photo);

        if (!empty($old_photo->$photo)) {
            File::delete('img/products/' . $old_photo->$photo);
        }

        $file_name = time() . "_" . $file->getClientOriginalName();

        $file->move('img/products', $file_name);

        Photo::where('photo1', $product->photo1)->update([
            $photo => $file_name
        ]);

        return redirect('/products' . '/' . $id . '/edit')->with('success', 'Photo has been updated');
    }

    public function destroyPicture($id, $photo)
    {
        $product = Product::find($id);
        $old_photo = Photo::where('photo1', $product->photo1)->first();
        File::delete('img/products/' . $old_photo->$photo);

        Photo::where('photo1', $product->photo1)->update([
            $photo => null
        ]);

        return redirect('/products' . '/' . $id . '/edit')->with('success', 'Photo has been deleted');
    }
}
