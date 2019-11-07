@extends('layouts.master')
@section('title')
{{ $title }} - Xylo Decoration
@endsection
@section('content')
<main class="catalog-page" style="margin-top: 62px">
    <section class="clean-block clean-catalog dark pt-5">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="p-4 mt-2">
                            <div class="filter-item mb-3">
                                <form action="{{ route('search') }}" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Mebel..." name="keyword" autocomplete="off" value="{{ old('keyword') }}">
                                        <div class="input-group-append">
                                            <input class="btn btn-primary" type="submit" name="submit" value="Cari">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="filter-item mb-3">
                                <select class="form-control" name="category" id="categorySearch">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                    @if ($category->category == $title)
                                    <option selected value="{{ $category->category }}">{{ $category->category }}</option>
                                    @else
                                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-item mb-3">
                                <select class="form-control" name="type" id="typeSearch">
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="products">
                            @if ($products[0] == null)
                            <div class="text-center">
                                <h2>Produk belum tersedia</h2>
                            </div>
                            @endif
                            <div class="row no-gutters">
                                @foreach ($products as $product)                                        
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="clean-product-item">
                                        <div class="image text-center">
                                            <a href="{{ route('details-product', ['id' => $product->id, 'name' => strtolower(str_replace(' ','-',$product->name))] )}}">
                                                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active ">
                                                            <img class="w-100" src="{{ asset('img/products/'.$product->images[0]->image) }}" alt="{{ $product->images[0]->image }}">
                                                        </div>
                                                        @foreach ($product->images as $image)
                                                        @if ($image->image != $product->images[0]->image)
                                                        <div class="carousel-item">
                                                            <img class="w-100" src="{{ asset('img/products/'.$image->image) }}" alt="{{ $image->image }}">
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="product-name">
                                            <a href="{{ route('details-product', ['id' => $product->id, 'name' => strtolower(str_replace(' ','-',$product->name))] )}}">
                                                {{ $product->name }}
                                            </a>
                                        </div>
                                        <div class="about">
                                            <div class="price">
                                                <h3>
                                                    Rp. {{ number_format($product->price, 2, ',', '.') }}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <nav>
                                {{ $products->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
