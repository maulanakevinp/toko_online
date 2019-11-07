<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Type;
use App\Image;
use App\Rules\uploadImage;
use Illuminate\Http\Request;
use File;
use Alert;

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
        $title = 'Bisnis';
        $subtitle = 'Produk';
        $categories = Category::all();
        $products = Product::paginate(15);
        return view('products.index', compact('title','subtitle','categories','products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $categories = Category::all();
        $products = Product::where('name', 'like', '%' . $keyword . '%')->paginate(15);
        $title = 'Bisnis';
        $subtitle = 'Cari Produk';

        return view('products.index', compact('title','subtitle', 'categories', 'products'));
    }

    public function category($cat)
    {
        $cat = str_replace('-', ' ', $cat);
        $categories = Category::all();
        $category = Category::where('category', $cat)->first();
        $products = Product::whereHas('type',function($q) use ($category){
            $q->whereCategoryId($category->id);
        })->paginate(15);
        $types = Type::where('category_id', $category->id)->get();
        $subtitle = $category->category;
        $title = 'Bisnis';

        return view('products.category', compact('title','subtitle', 'categories', 'products','types'));
    }

    public function type($id, $cat)
    {
        $cat = str_replace('-', ' ', $cat);
        $categories = Category::all();
        $category = Category::where('category', $cat)->first();
        $products = Product::where('type_id', $id)->paginate(15);
        $types = Type::where('category_id', $category->id)->get();
        $type = Type::find($id);
        $subtitle = $type->type;
        $title = 'Bisnis';
        return view('products.type', compact('title','subtitle', 'categories', 'products', 'types'));
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
        $title = 'Bisnis';
        $categories = Category::all();
        return view('products.create', compact('categories','title'));
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
            'name'          => 'required',
            'price'         => 'required|numeric',
            'category'      => 'required',
            'type'          => 'required',
            'description'   => 'required',
            'images'        => ['required', new uploadImage($request, 'images')]
        ]);
        
        $product = Product::create([
            'name'          => $request->name,
            'type_id'       => $request->type,
            'price'         => $request->price,
            'bukalapak'     => $request->bukalapak,
            'tokopedia'     => $request->price,
            'olx'           => $request->olx,
            'description'   => $request->description,
            'specification' => $request->specification,
        ]);

        foreach ($request->images as $img) {
            $image = new Image;
            $image->product_id = $product->id;
            $image->image = $this->setImageUpload($img,'img/products');
            $image->save();
        }
        Alert::success('Produk berhasil ditambahkan', 'berhasil');
        return redirect('/products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Bisnis';
        $products = new Product;
        $product = $products->findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('title','product','categories','title'));
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

        Alert::success('Produk berhasil diperbarui', 'berhasil');
        return redirect()->back();
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

        foreach ($product->images as $image) {
            File::delete(public_path('img/products/' . $image->image));
        }

        Product::destroy($id);
        Alert::success('Produk berhasil dihapus', 'berhasil');
        return redirect('/products');
    }

    public function addProductImage(Request $request, $id)
    {
        $request->validate(['image' => ['required', 'image', 'mimes:jpeg,png', 'max:2048']]);
        $image = new Image;
        $image->image = $this->setImageUpload($request->image,'img/products');
        $image->product_id = $id;
        $image->save();
        Alert::success('Foto berhasil ditambahkan', 'berhasil');
        return redirect()->back();
    }

    public function updateProductImage(Request $request,$id)
    {
        $request->validate(['image' => ['required', 'image','mimes:jpeg,png','max:2048']]);
        $image = Image::findOrFail($id);
        $image->image = $this->setImageUpload($request->image,'img/products',$image->image);
        $image->save();
        Alert::success('Foto berhasil di perbarui', 'berhasil');
        return redirect()->back();
    }

    public function destroyProductImage($id)
    {
        $image = Image::findOrFail($id);
        File::delete(public_path('img/products/' . $image->image));
        $image->delete();
        Alert::success('Foto berhasil dihapus', 'berhasil');
        return redirect()->back();
    }
    
}
