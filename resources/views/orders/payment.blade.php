@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')
    <main class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                @if ($order->verify == 1)
                    <div class="block-heading">
                        <h2 class="text-info">Pesanan anda sedang dalam proses pengiriman</h2>
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
                        @else
                            <div class="form-group mt-5">
                                <label>Apabila pesanan telah anda terima harap klik tomobol terima dibawah ini dan berikan ulasan anda</label>
                                <a href="#ulasan" class="btn btn-block btn-success" data-toggle="modal">Terima</a>
                            </div>
                        @endif
                    </div>
                </form>
                @if ($order->verify != 1)
                    <button class="btn btn-block btn-success">Pesanan telah sampai</button>
                    <form action="{{ route('orders.destroy',$order) }}" method="post">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-block btn-danger">Batalkan Pemesanan</button>
                    </form>
                @endif
            </div>
        </section>
    </main>

    <div id="ulasan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ulasan" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ulasan">Ulasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <h1>Pure CSS Star Rating Widget</h1>
                        <fieldset class="rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        fieldset, label { margin: 0; padding: 0; }
        body{ margin: 20px; }
        h1 { font-size: 1.5em; margin: 10px; }

        /****** Style Star Rating Widget *****/

        .rating { 
        border: none;
        float: left;
        }

        .rating > input { display: none; } 
        .rating > label:before { 
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
        }

        .rating > .half:before { 
        content: "\f089";
        position: absolute;
        }

        .rating > label { 
        color: #ddd; 
        float: right; 
        }

        /***** CSS Magic to Highlight Stars on Hover *****/

        .rating > input:checked ~ label, /* show gold star when clicked */
        .rating:not(:checked) > label:hover, /* hover current star */
        .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

        .rating > input:checked + label:hover, /* hover current star when changing rating */
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
        .rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
    </style>
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