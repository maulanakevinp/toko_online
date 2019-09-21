<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Category;
use App\Photo;
use App\Testimonial;
use App\Type;
use App\Product;

class HomeController extends Controller
{
    public function index()
    {
        $company = Company::find(1);
        $testimonials = Testimonial::all();
        $categories = Category::all();
        $photo = Photo::where('photo1', $company->photo1)->first();

        return view('index', [
            'company' => $company,
            'testimonials' => $testimonials,
            'categories' => $categories,
            'photo' => $photo
        ]);
    }

    public function products()
    {
        $company = Company::find(1);
        $categories = Category::all();
        $products = Product::paginate(15);
        $title = 'Produk';

        return view('products', [
            'title' => $title,
            'company' => $company,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $company = Company::find(1);
        $categories = Category::all();
        $products = Product::where('name', 'like', '%' . $keyword . '%')->paginate(15);
        $title = 'Produk';

        return view('products', [
            'title' => $title,
            'company' => $company,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function category($cat)
    {
        $cat = str_replace('-', ' ', $cat);
        $company = Company::find(1);
        $categories = Category::all();
        $category = Category::where('category', $cat)->first();
        $product = new Product;
        $products = $product->category($category->id);
        $types = Type::where('category_id', $category->id)->get();
        $title = $category->category;

        return view('category', [
            'title' => $title,
            'company' => $company,
            'types' => $types,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function type($id, $cat)
    {
        $cat = str_replace('-', ' ', $cat);
        $company = Company::find(1);
        $categories = Category::all();
        $category = Category::where('category', $cat)->first();
        $products = Product::where('type_id', $id)->paginate(15);
        $types = Type::where('category_id', $category->id)->get();
        $type = Type::find($id);
        $title = $type->type;

        return view('type', [
            'title' => $title,
            'company' => $company,
            'types' => $types,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detailsProduct($id, $name)
    {
        $company = Company::find(1);
        $products = new Product;
        $product = $products->product($id);
        $title = $product->name;
        $photo = Photo::where('photo1', $product->photo1)->first();
        return view('details-product', [
            'title' => $title,
            'company' => $company,
            'product' => $product,
            'photo' => $photo
        ]);
    }
}
