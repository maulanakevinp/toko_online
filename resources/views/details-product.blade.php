@extends('layouts.master')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('content')
<main>
    <section class="clean-block clean-product">
        <div class="container">
            <nav aria-label="breadcrumb" style="margin-top: 100px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('category',['category' => strtolower(str_replace(' ','-', $product->type->category->category))] )}}">
                            {{ $product->type->category->category }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('type',['type' => $product->type_id, 'category' => strtolower(str_replace(' ','-', $product->type->category->category))] ) }}">
                            {{ $product->type->type }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $title }}
                    </li>
                </ol>
            </nav>
            <div class="block-content">
                <div class="product-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gallery">
                                <div class="sp-wrap m-0">
                                    @foreach ($product->images as $image)
                                        <a href="{{ asset('img/products/'.$image->image) }}">
                                            <img class="img-fluid d-block mx-auto" src="{{ asset('img/products/'.$image->image) }}">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <h1 class="h3">{{ $title }}</h1>
                                <span class="text-muted">Stok tersisa : {{ $product->stock }} produk</span>
                                <hr>
                                <h4>Pesan Melalui</h4>
                                <div class="clean-block add-on social-icons">
                                    <div class="icons">
                                        @if (!empty($product->bukalapak))
                                        <a href="{{ $product->bukalapak }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/bukalapak.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                                        @endif
                                        @if (!empty($product->tokopedia))
                                        <a href="{{ $product->tokopedia }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/tokopedia.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                                        @endif
                                        @if (!empty($product->olx))
                                        <a href="{{ $product->olx }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/olx.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="summary p-0 ">
                                    <div class="price">
                                        <h3>Rp. {{ number_format($product->price, 2, ',', '.') }}<br></h3>
                                        <form action="{{ route('orders.add_to_cart',$product->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-shopping-cart"></i> Tambahkan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-info">
                    <div>
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" id="description-tab" href="#description">Deskripsi</a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" id="specifications-tabs" href="#specifications">Spesifikasi</a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" id="reviews-tab" href="#reviews">Review</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active fade show description" role="tabpanel" id="description">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane fade show specifications" role="tabpanel" id="specifications">
                                {!! $product->specification !!}
                            </div>
                            <div class="tab-pane fade show" role="tabpanel" id="reviews">
                                @foreach ($product->reviews as $review)
                                    <div class="reviews">
                                        <div class="review-item">
                                            <div class="rating">
                                                @if ($review->rating == 1)
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                @elseif($review->rating == 2)
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                @elseif($review->rating == 3)
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                @elseif($review->rating == 4)
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star-empty.svg')}}">
                                                @elseif($review->rating == 5)
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                <img src="{{asset('img/star.svg')}}">
                                                @endif
                                            </div>
                                            <h4 class="font-weight-bold">{{ $review->title }}</h4>
                                            <span class="text-muted">
                                                <a href="#">{{ $review->name }}</a>, {{ $review->created_at->format('d M Y - H:i:s') }}
                                            </span>
                                            <p>{{ $review->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection