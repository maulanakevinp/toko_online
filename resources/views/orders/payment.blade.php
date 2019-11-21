@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')
    <main class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">{{ $title }}</h2>
                </div>
                <form action="{{ route('orders.update',$order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="products">
                        <h3 class="title">{{ $title }}</h3>
                        @foreach ($order->products as $orderDetail)
                            <div class="item">
                                <span class="price">Rp. {{ number_format($orderDetail->price, 2, ',', '.') }}</span>
                                <p class="item-description">{{ $orderDetail->name }}</p>
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
                            <img class="mw-100" id="displayImage" src="" alt="">
                        </div>
                        <div class="form-group input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" aria-describedby="image">
                                <label class="custom-file-label" for="image">Pilih gambar</label>
                            </div>
                            {!! $errors->first('image', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Proses</button></div>
                    </div>
                </form>
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