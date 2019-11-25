@extends('layouts.admin')
@section('title')
Detail Order - {{ config('app.name') }}
@endsection
@section('container')
<div class="container-fluid">
    <div class="card shadow h-100">
        <div class="card-header">
            <h5 class="m-0 pt-1 font-weight-bold text-black-50">Data Pembeli</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $order->address }}</td>
                                </tr>
                                <tr>
                                    <td>Bukti Transfer</td>
                                    <td><a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fileDetail"><i class="fas fa-file-image"></i> File Detail</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if ($order->status == 1)
                                            Diterima
                                        @elseif ($order->status == 2)
                                            Dalam proses pengiriman
                                        @else
                                            Belum diproses
                                        @endif
                                    </td>
                                </tr>
                                @if ($order->verify != 1)
                                    <tr>
                                        <td>Verifikasi Pesanan</td>
                                        <td>
                                            <form class="float-left" action="{{ route('orders.approving', $order) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-sm btn-outline-success" type="submit">Terima</button>
                                            </form>
                                            <a class="btn btn-sm btn-outline-danger" data-toggle="collapse" href="#declineVerificationModal">Tolak</a>
                                            <div class="collapse multi-collapse" id="declineVerificationModal">
                                                <form action="{{ route('orders.rejecting', $order) }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="form-group">
                                                        <div class="col-form-label">Alasan Penolakan</div>
                                                        <textarea class="form-control @error('alasan_penolakan') is-invalid @enderror" name="alasan_penolakan" id="alasan_penolakan" rows="2">{{ old('alasan_penolakan', $order->reason) }}</textarea>
                                                        @error('alasan_penolakan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                                    </div>
                                                    <button class="btn btn-primary btn-sm" type="submit">Verifikasi</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<main class="page shopping-cart-page">
    <section class="clean-block clean-cart">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Data Pesanan</h2>
            </div>
            <div class="content shadow h-100">
                <div class="row no-gutters">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            @foreach($order->products as $product)
                                <div class="product">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-3">
                                            <div class="product-image"><img class="img-fluid d-block mx-auto image" src="{{ asset('img/products/'.$product->images[0]->image) }}"></div>
                                        </div>
                                        <div class="col-md-4 product-info"><a class="product-name block-with-text" href="{{ route('details-product', ['id' => $product->id, 'name' => strtolower(str_replace(' ','-',$product->name))]) }}">{{ $product->name }}</a>
                                            <div class="product-specs">
                                                <div><span>Harga: </span><span class="value">Rp. {{ number_format($product->price, 2, ',', '.') }}</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-2 quantity">
                                            <label class="d-none d-md-block" for="quantity">Quantity</label>
                                            <input type="number" id="qty" class="form-control quantity-input" value="{{ $product->pivot->qty }}" disabled>
                                        </div>
                                        <div class="col-6 col-md-3 "><span>{{ number_format($product->pivot->qty * $product->price, 2, ',', '.') }}</span></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="summary">
                            <h3>Ringkasan</h3>
                            <h4>
                                <span class="text">Total</span>
                                <span class="price font-weight-bold">
                                    {{ number_format($order->subtotal, 2, ',', '.') }}
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div id="fileDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailNIK" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailNIK">File Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-left">
                    <select onchange="rotateImage('#nik_image',this.value)">
                        <option value="">Putar</option>
                        <option value="90">90</option>
                        <option value="180">180</option>
                        <option value="270">270</option>
                        <option value="360">360</option>
                    </select>
                </div>
                <div class="text-center">
                    <img id="nik_image" class="mw-100" src="{{url('img/orders/'.$order->image) }}" alt="{{ $order->image     }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function rotateImage(image,degree) {
            $(image).animate({
                transform: degree
            }, {
                step: function (now, fx) {
                    $(this).css({
                        '-webkit-transform': 'rotate(' + now + 'deg)',
                        '-moz-transform': 'rotate(' + now + 'deg)',
                        'transform': 'rotate(' + now + 'deg)',
                        'margin': '0',
                    });
                }
            });
        }
    </script>
@endsection