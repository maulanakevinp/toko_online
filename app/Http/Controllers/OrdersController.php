<?php

namespace App\Http\Controllers;

use App\Company;
use App\Order;
use App\Product;
use Alert;
use App\OrderProduct;
use Illuminate\Http\Request;
use Mail;
use File;
use DataTables;
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
            $subtotal = $subtotal + ($details['price'] * $details['qty']);
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
            $orderProduct = new OrderProduct();
            $orderProduct->order_id      = $order->id;
            $orderProduct->product_id    = $details['id'];
            $orderProduct->price         = $details['price'];
            $orderProduct->qty           = $details['qty'];
            $orderProduct->save();
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
        if (!auth()->user()) {
            return abort(404);
        }
        $title = 'Dashboard';
        return view('orders.show',compact('order','title'));
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
        $request->validate([
            'image' => ['required','image','mimes:jpeg,png','max:2048']
        ]);

        if ($order->image) {
            $order->image = $this->setImageUpload($request->image,'img/orders',$order->image);
        } else {
            $order->image = $this->setImageUpload($request->image,'img/orders');
        }

        $order->verify == null;
        $order->reason == null;
        $order->save();

        Alert::success('Bukti transfer Berhasil dikirim, Admin kami akan segera melakukan pengiriman, harap selalu cek email anda','Berhasil')->persistent('tutup');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->image) {
            File::delete(public_path('img/orders/'.$order->image));
        }
        $order->delete();
        Alert::success('Pesanan berhasil dibatalkan','Berhasil');
        return redirect('/');
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
            if ($cart[$id]['qty'] > $product->stock) {
                $cart[$id]['qty']--;
            }
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
        } elseif($request->qty > $product->stock){
            Alert::error('Quantity tidak boleh melebihi stok yang tersedia','Gagal Menambahkan Quantity')->persistent('tutup');
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

        if (time() - strtotime($order->created_at) > (60 * 60 * 24) && $order->image == null) {
            $order->delete();
            return abort(404);
        }

        if ($order->verify == 1 && $order->status == 1) {
            return abort(404);
        }

        $title = 'Pembayaran';
        $company = Company::find(1);
        return view('orders.payment',compact('title','company','order'));
    }

    public function getOrderEntry()
    {
        $orders = Order::whereVerify(null)->where('image','!=',null)->select('orders.*');
        return DataTables::eloquent($orders)
            ->addColumn('tanggal_pemesanan', function ($order)
            {
                return $order->created_at->format('d M Y - H:i:s');
            })
            ->addColumn('opsi', function($order){
                return '<a href="'.route('orders.show',$order).'" class="badge badge-primary" data-toggle="tooltip" title="Detail Order"><i class="fas fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['tanggal_pemesanan','opsi'])
            ->toJson();
    }
    public function getOrderProcessed()
    {
        $orders = Order::whereVerify(1)->select('orders.*');
        return DataTables::eloquent($orders)
            ->addColumn('tanggal_pemesanan', function ($order)
            {
                return $order->created_at->format('d M Y - H:i:s');
            })
            ->addColumn('opsi', function($order){
                return '<a href="'.route('orders.show',$order).'" class="badge badge-primary" data-toggle="tooltip" title="Detail Order"><i class="fas fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['tanggal_pemesanan','opsi'])
            ->toJson();
    }
    public function getOrderFinished()
    {
        $orders = Order::whereStatus(1)->select('orders.*');
        return DataTables::eloquent($orders)
            ->addColumn('tanggal_pemesanan', function ($order)
            {
                return $order->created_at->format('d M Y - H:i:s');
            })
            ->addColumn('opsi', function($order){
                return '<a href="'.route('orders.show',$order).'" class="badge badge-primary" data-toggle="tooltip" title="Detail Order"><i class="fas fa-fw fa-eye"></i></a>';
            })
            ->rawColumns(['tanggal_pemesanan','opsi'])
            ->toJson();
    }

    public function approving(Order $order)
    {
        $order->verify = 1;
        $order->status = 2;
        $order->save();

        try{
            Mail::send('orders.email_approving', [
                'nama'      => $order->name,
                'invoice'   => $order->invoice,
            ], function ($message) use ($order) {
                $message->subject('Pesanan dalam proses pengiriman');
                $message->from('admin@xylodecoration.com', 'Admin Xylo Decoration');
                $message->to($order->email);
            });
        }catch (Exception $e){
            Alert::error('Email harus valid','Gagal Mengirim email')->persistent('tutup');
            return back();
        }

        Alert::success('Pesanan Berhasil diterima','Berhasil');
        return back();
    }

    public function rejecting(Request $request, Order $order)
    {
        $request->validate([
            'alasan_penolakan' => ['required']
        ]);

        $order->verify = -1;
        $order->reason = $request->alasan_penolakan;
        $order->save();

        try{
            Mail::send('orders.email_rejecting', [
                'nama'      => $order->name,
                'invoice'   => $order->invoice,
                'reason'    => $request->alasan_penolakan,
            ], function ($message) use ($order) {
                $message->subject('Pesanan ditolak');
                $message->from('admin@xylodecoration.com', 'Admin Xylo Decoration');
                $message->to($order->email);
            });
        }catch (Exception $e){
            Alert::error('Email harus valid','Gagal Mengirim email')->persistent('tutup');
            return back();
        }

        Alert::success('Pesanan Berhasil ditolak','Berhasil');
        return back();
    }
}
