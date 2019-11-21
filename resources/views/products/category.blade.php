@extends('layouts.admin')
@section('title')
{{ $subtitle }} - {{ config('app.name')}}
@endsection

@section('container')
<section class="clean-block clean-catalog">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah produk baru</a>
            </div>
            <div class="col-md-3 mb-3">
                <select class="form-control" name="category" id="categorySearch">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        @if ($category->category == $kategori->category)
                            <option selected value="{{ $category->category }}">{{ $category->category }}</option>
                        @else
                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <select class="form-control" name="type" id="typeSearch">
                    <option value="">Pilih tipe</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <form action="{{ route('search-products') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari produk" name="keyword" autocomplete="off" value="{{ old('keyword') }}">
                        <div class="input-group-append">
                            <input class="btn btn-primary" type="submit" value="Search">
                        </div>
                    </div>
                    @if ($title == 'Cari Produk')
                        <p class="ml-2 mt-2">
                            Hasil :  {{ $count }}
                        </p>
                    @endif
                </form>
            </div>
        </div>
        <div class="content">
            <div class="products p-3">
                @if ($products[0] == null)
                <div class="text-center">
                    <h5 class="font-weight-bold">Produk Belum Tersedia</h5>
                </div>
                @endif
                <div class="row no-gutters">
                    @foreach ($products as $product)                                        
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="clean-product-item">
                                <div class="image text-center">
                                    <a href="{{ route('products.edit', $product->id ) }}">
                                        <div class="carousel slide" data-ride="carousel" id="carousel-1">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active ">
                                                    <img class="w-100" height="200px" src="{{ asset('img/products/'.$product->images[0]->image) }}" alt="{{ $product->images[0]->image }}">
                                                </div>
                                                @foreach ($product->images as $image)
                                                @if ($image->image != $product->images[0]->image)
                                                <div class="carousel-item">
                                                    <img class="w-100" height="200px" src="{{ asset('img/products/'.$image->image) }}" alt="{{ $image->image }}">
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="product-name">
                                    <a href="{{ route('products.edit', $product->id ) }}">
                                        <p class="block-with-text" data-toogle="tooltip" title="{{ $product->name }}">{{ $product->name }}</p>
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
</section>
@endsection
