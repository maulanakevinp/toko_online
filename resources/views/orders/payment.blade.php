@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')
    <main class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                @if ($order->verify == 1 && $order->status == 2)
                    <div class="block-heading">
                        <h2 class="text-info">Pesanan anda sedang dalam proses pengiriman</h2>
                        <p>ID Pesanan : {{ $order->invoice }}</p>
                    </div>
                @elseif ($order->verify == 1 && $order->status == 1)
                    <div class="block-heading">
                        <h2 class="text-info">Pesanan telah diterima</h2>
                        <p>ID Pesanan : {{ $order->invoice }}</p>
                    </div>
                @else
                    <div class="block-heading">
                        <h2 class="text-info">{{ $title }}</h2>
                        <p>ID Pesanan : {{ $order->invoice }}</p>
                    </div>
                @endif
                <form action="{{ route('orders.update',$order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('patch')
                    <div class="products">
                        <h3 class="title">Tagihan</h3>
                        @foreach ($order->products as $orderProduct)
                            <div class="row">
                                <div class="col-md-7">
                                    <p class="item-description">{{ $orderProduct->name }}</p>
                                </div>
                                <div class="col-md-1">
                                    <p class="item-description">{{ $orderProduct->pivot->qty }}</p>
                                    
                                </div>
                                <div class="col-md-4">
                                    <span class="price">{{ number_format($orderProduct->price * $orderProduct->pivot->qty, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="total"><span>Total</span><span class="price">Rp. {{ number_format($order->subtotal, 2, ',', '.') }}</span></div>
                    </div>
                    <div class="card-details">
                        <h3 class="title">Data Pembeli</h3>
                        <div class="form-group">
                            <label for="card-holder">Nama</label>
                            <input class="form-control" type="text" name="nama" placeholder="Nama" value="{{ $order->name }}" disabled>
                        </div>
                        <div class="form-group"><label>Email</label>
                            <div class="input-group expiration-date">
                                <input class="form-control" type="text" name="email" placeholder="Email" value="{{ $order->email }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="card-number">Nomor Telepon</label>
                            <input class="form-control" type="text" name="nomor_telepon" placeholder="Nomor Telepon" value="{{ $order->phone }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="cvc">Alamat</label>
                            <input class="form-control" type="text" name="alamat" placeholder="Alamat" value="{{ $order->address }}" disabled>
                        </div>
                        <label for="cvc">Bukti Transfer</label>
                        <div class="text-center">
                            <img class="mw-100" id="displayImage" src="{{ asset('img/orders/'.$order->image) }}" alt="">
                        </div>
                        @if ($order->verify != 1)
                            <div class="form-group input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid  @enderror" id="image" name="image" aria-describedby="image">
                                    <label class="custom-file-label" for="image">Pilih gambar @error('image') harus diisi @enderror</label>
                                </div>
                            </div>
                            @if ($order->image)
                                <div class="form-group"><button class="btn btn-success btn-block" type="submit">Ganti Bukti Transfer</button></div>
                            @else
                                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Proses</button></div>
                            @endif
                            <p class="">Harap melakukan transfer senilai total diatas dan kirim ke rekening kami dibawah ini (Pilih salah satu)</p>
                            <p>BCA : {{ $company->bca }}</p>
                            <p>BNI : {{ $company->bni }}</p>
                        @endif
                    </div>
                </form>
                @if ($order->verify == 1 && $order->status == 2)
                    <form class="p-5" action="{{ route('orders.accepting',$order) }}" method="post">
                        @csrf
                        <label>Apabila pesanan telah anda terima harap klik tombol terima dibawah ini dan berikan ulasan anda</label>
                        <button class="btn btn-block btn-success" type="submit">Terima</button>
                    </form>
                @elseif($order->verify != 1)
                    <form action="{{ route('orders.destroy',$order) }}" method="post">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-block btn-danger">Batalkan Pemesanan</button>
                    </form>
                @endif
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {

            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#displayImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endpush