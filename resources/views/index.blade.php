@extends('layouts.master')
@section('title')
Home - {{ config('app.name') }}
@endsection
@section('content')
<section id="carousel" style="margin-top: 62px">
    <div class="carousel slide" data-ride="carousel" id="carousel-1">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active ">
                <img class="w-100" src="{{ asset('img/carousel/'.$company->images[0]->image) }}" alt="{{ $company->images[0]->image }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ config('app.name') }}</h5>
                </div>
            </div>
            @foreach ($company->images as $image)
            @if ($image->image != $company->images[0]->image)
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('img/carousel/'.$image->image) }}" alt="{{ $image->image }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ config('app.name') }}</h5>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
    </div>
</section>
    <main class="landing-page">
    <section id="about" class="clean-block clean-hero" style="background-image: url(&quot;{{ asset('img/navbar/gambar-background-kayu-hd.jpg') }}&quot;);color: rgba(9,162,255,0.24);">
        <div class="text">
            <h2>By {{ $company->name }}<br></h2>
            <p>{{ $company->description }}</p>
        </div>
    </section>
    <section class="clean-block clean-info dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Silahkan Pilih Kategori</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($categories as $category)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <a class="card-link" href="{{ route('category',['category' => strtolower(str_replace(' ','-', $category->category))] )}}" style="font-size: 20px;">
                        <div class="card shadow-sm">
                            <img class="card-img-top" style="height: 200px" src="{{asset('/img/categories/'.$category->photo)}}">
                            <div class="card-body text-center">
                                <h5>{{$category->category}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="clean-block features">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Pesan Melalui</h2>
                <div class="clean-block add-on social-icons">
                    <div class="icons">
                        <a href="{{ $company->bukalapak }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/bukalapak.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                        <a href="{{ $company->tokopedia }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/tokopedia.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                        <a href="{{ $company->olx }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/olx.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                        <a href="{{ $company->whatsapp }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/whatsapp.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                        <a href="{{ $company->line }}" target="_blank" style="width: 80px;height: 80px;"><img src="{{ asset('img/e-commerce/line.png') }}" style="width: 80px;height: 80px;padding: 15px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<div id="client" class="testimonials-clean">
    <div class="container">
        <div class="intro pt-5">
            <h2 class="text-center">Testimonial</h2>
            <p class="text-center">{{ $company->testimonial }}</p>
        </div>
        <div class="row people justify-content-center">
            @foreach ($testimonials as $testimonial)
            <div class="col-md-6 col-lg-4 item">
                <div class="box">
                    <p class="description"> {{$testimonial->description}} </p>
                </div>
                <div class="author">
                    <img class="rounded-circle" src="{{asset('/img/testimonial/'.$testimonial->photo)}}">
                    <h5 class="name"> {{$testimonial->name}} </h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="map-clean">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Alamat</h2>
            <p class="text-center">{{$company->address}} <br>Telp : {{$company->phone_number}}</p>
        </div>
    </div>
    <iframe src="{{ $company->maps }}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
@endsection
