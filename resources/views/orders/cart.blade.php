@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')
    @if (session('cart'))
        <main class="page shopping-cart-page">
            <section class="clean-block clean-cart dark">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="text-info">{{ $title }}</h2>
                    </div>
                    <div class="content">
                        <div class="row no-gutters">
                            <div class="col-md-12 col-lg-8">
                                <div class="items">
                                    @foreach(session('cart') as $id => $details)
                                        <div class="product">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-3">
                                                    <div class="product-image"><img class="img-fluid d-block mx-auto image"
                                                            src="{{ asset('img/products/'.$details['photo']) }}"></div>
                                                </div>
                                                <div class="col-md-4 product-info"><a class="product-name" href="{{ route('details-product', ['id' => $details['id'], 'name' => strtolower(str_replace(' ','-',$details['name']))]) }}">{{ $details['name'] }}</a>
                                                    <div class="product-specs">
                                                        <div><span>Harga: </span><span class="value">Rp. {{ number_format($details['price'], 2, ',', '.') }}</span></div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2 quantity">
                                                    <label class="d-none d-md-block" for="quantity">Quantity</label>
                                                    <input data-id="{{ $details['id'] }}" type="number" id="qty" class="form-control quantity-input" value="{{ $details['qty'] }}">
                                                </div>
                                                <div class="col-6 col-md-3 price"><span>{{ number_format($details['qty'] * $details['price'], 2, ',', '.') }}</span></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="summary">
                                    <h3>Ringkasan</h3>
                                    <h4>
                                        <span class="text">Total</span><span class="price">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach (session('cart') as $id => $details)
                                                @php
                                                    $total = $total + $details['qty'] * $details['price'];
                                                @endphp
                                            @endforeach
                                            {{ number_format($total, 2, ',', '.') }}
                                        </span>
                                    </h4>
                                    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-block btn-lg" type="button">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.quantity-input').on('change',function () {
                let qty = $(this).val();
                let id  = $(this).data('id');
                console.log(qty);
                if (qty < 0) {
                    alert('Quantity tidak boleh dibawah 0');
                    $(this).val(0);
                } else {
                    $.ajax({
                        url: "{{ route('ajax.orders.update_qty') }}",
                        method: "patch",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            qty: qty
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush