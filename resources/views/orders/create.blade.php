@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')

    @if (session('cart'))
        <main class="page payment-page">
            <section class="clean-block payment-form dark">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="text-info">{{ $title }}</h2>
                    </div>
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="products">
                            <h3 class="title">Checkout</h3>
                            @foreach (session('cart') as $id => $details)
                                <div class="item">
                                    <span class="price">Rp. {{ number_format($details['price'] * $details['qty'], 2, ',', '.') }}</span>
                                    <p class="item-description">{{ $details['name'] }}</p>
                                </div>
                            @endforeach
                            @php
                                $total = 0;
                            @endphp
                            @foreach (session('cart') as $id => $details)
                                @php
                                    $total = $total + $details['qty'] * $details['price'];
                                @endphp
                            @endforeach
                            <div class="total"><span>Total</span><span class="price">Rp. {{ number_format($total, 2, ',', '.') }}</span></div>
                        </div>
                        <div class="card-details">
                            <h3 class="title">Data Pembeli</h3>
                            <div class="form-group">
                                <label for="card-holder">Nama</label>
                                <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" placeholder="Nama" value="{{ old('nama') }}">
                                @error('nama') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                                @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="card-number">Nomor Telepon</label>
                                <input class="form-control @error('nomor_telepon') is-invalid @enderror" type="text" name="nomor_telepon" placeholder="Nomor Telepon" value="{{ old('nomor_telepon') }}">
                                @error('nomor_telepon') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input class="form-control @error('alamat') is-invalid @enderror" type="text" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                                @error('alamat') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Proses</button></div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    @else
        <main class="page shopping-cart-page">
            <section class="clean-block clean-cart dark">
                <div class="container p-5">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center">Belum ada produk didalam keranjang</h2>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @endif
@endsection