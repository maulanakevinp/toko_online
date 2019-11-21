<?php

namespace App\Http\Controllers;

use App\Company;
use App\Order;
use App\Product;
use Alert;
use App\OrderDetail;
use Illuminate\Http\Request;
use Mail;
use File;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pesanan';
        $company = Company::find(1);
        return view('orders.index',compact('title','company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Checkout';
        $company = Company::find(1);
        return view('orders.create',compact('title','company'));
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
            'nama'          => ['required','max:60'],
            'email'         => ['required','max:60','email'],
            'nomor_telepon' => ['required','digits_between:6,13'],
            'alamat'        => ['required']
        ]);
        
        $invoice = Str::random(32);
        $cart = session()->get('cart');
        $subtotal = 0;
        foreach (session('cart') as $id => $details) {
            $subtotal = $subtotal + $details['price'];
        }
        try{
            Mail::send('orders.email', [
                'nama'      => $request->nama,
                'invoice'   => $invoice,
            ], function ($message) use ($request) {
                $message->subject('Tagihan');
                $message->from('admin@xylodecoration.com', 'Admin Xylo Decoration');
                $message->to($request->email);
            });
        }catch (Exception $e){
            Alert::error('Email harus valid','Gagal Mengirim email')->persistent('tutup');
            return back();
        }
        
        $order = Order::create([
            'invoice'   => $invoice,
            'name'      => $request->nama,
            'email'     => $request->email,
            'phone'     => $request->nomor_telepon,
            'address'   => $request->alamat,
            'subtotal'  => $subtotal
        ]);
        foreach (session('cart') as $id => $details) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id      = $order->id;
            $orderDetail->product_id    = $details['id'];
            $orderDetail->price         = $details['price'];
            $orderDetail->qty           = $details['qty'];
            $orderDetail->save();
            unset($cart[$details['id']]);
        }
        session()->put('cart', $cart);
        Alert::success('Silahkan cek email anda untuk melanjutkan pembayaran','Email Terkirim')->persistent('tutup');
        return redirect('/product');
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
        return view('orders.cart',compact('title','company'));
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
            Alert::success('Produk berhasil ditambahkan ke keranjang','Berhasil');
            return redirect()->back();
        }

        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
            session()->put('cart', $cart);
            Alert::success('Produk berhasil ditambahkan ke keranjang','Berhasil');
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
        Alert::success('Produk berhasil ditambahkan ke keranjang','Berhasil');
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

    public function payment($invoice)
    {
        $order = Order::whereInvoice($invoice)->first();

        if ($order == null) {
            return abort(404);
        }

        if (time() - strtotime($order->created_at) > (60 * 60 * 24)) {
            $order->delete();
            return abort(404);
        }

        $title = 'Pembayaran';
        $company = Company::find(1);
        return view('orders.payment',compact('title','company','order'));
    }
}
