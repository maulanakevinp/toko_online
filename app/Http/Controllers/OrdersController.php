<?php

namespace App\Http\Controllers;

use App\Company;
use App\Order;
use App\Product;
use Alert;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function cart(Request $request)
    {
        $title = 'Keranjang';
        $company = Company::find(1);
        return view('cart',compact('title','company'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $id => [
                    'id'    => $id,
                    'name'  => $product->name,
                    'qty'   => 1,
                    'price' => $product->price,
                    'photo' => $product->images[0]->image
                ]
            ];

            session()->put('cart', $cart); 
            Alert::success('Produk berhasil ditambahkan ke keranjang');
            return redirect()->back();
        }

        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
            session()->put('cart', $cart);
            Alert::success('Produk berhasil ditambahkan ke keranjang');
            return redirect()->back();
        }

        $cart[$id] = [
            'id'    => $id,
            'name'  => $product->name,
            'qty'   => 1,
            'price' => $product->price,
            'photo' => $product->images[0]->image
        ];

        session()->put('cart', $cart);
        // $request->session()->flush();
        Alert::success('Produk berhasil ditambahkan ke keranjang');
        return redirect()->back();
    }

    public function updateQty(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart');

        if ($request->qty == 0) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        } else {
            $cart[$request->id] = [
                'id'    => $request->id,
                'name'  => $product->name,
                'qty'   => $request->qty,
                'price' => $product->price,
                'photo' => $product->images[0]->image
            ];
            session()->put('cart', $cart);
        }
    }
}
