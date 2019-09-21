@extends('layouts.master')
@section('title')
{{ $title }} - Xylo Decoration
@endsection
@section('content')
<main>
    <section class="clean-block clean-product">
        <div class="container">
            <nav aria-label="breadcrumb" style="margin-top: 80px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('category',['category' => strtolower(str_replace(' ','-', $product->category))] )}}">
                            {{ $product->category }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('type',['type' => $product->type_id, 'category' => strtolower(str_replace(' ','-', $product->category))] ) }}">
                            {{ $product->type }}
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
                                <div class="sp-wrap">
                                    <a href="{{ asset('img/products/'.$product->photo1) }}">
                                        <img class="img-fluid d-block mx-auto" src="{{ asset('img/products/'.$product->photo1) }}">
                                    </a>
                                    @for ($i = 2; $i <= 6; $i++)
                                    @if (!empty($photo['photo'.$i]))
                                        <a href="{{ asset('img/products/'.$photo['photo'.$i]) }}">
                                            <img class="img-fluid d-block mx-auto" src="{{ asset('img/products/'.$photo['photo'.$i]) }}">
                                        </a>
                                    @endif                                        
                                    @endfor
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info">
                            <h3 class=" ">{{ $title }}</h3>
                            <div class="price">
                                <h3>Rp. {{ number_format($product->price, 2, ',', '.') }}<br></h3>
                            </div>
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
                            <div class="summary">
                                <p>{{ $product->description }}</p>
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