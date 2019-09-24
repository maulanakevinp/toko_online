@extends('layouts.admin')
@section('title')
{{ $title }} - Xylo Decoration
@endsection

@section('container')
<section class="clean-block clean-catalog">
    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('failed'))
                <div class="alert alert-danger">
                    {{ session('failed') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>
            </div>
            <div class="col-md-3 mb-3">
                <select class="form-control" name="category" id="categorySearch">
                    <option value="">Choose Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <select class="form-control" name="type" id="typeSearch">
                    <option value="">Choose Type</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <form action="{{ route('search-products') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Products" name="keyword" autocomplete="off" value="{{ old('keyword') }}">
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
                <div class="row no-gutters">
                    @foreach ($products as $product)                                        
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="clean-product-item">
                                <div class="image">
                                    <a href="{{ route('products.edit', $product->id ) }}">
                                        <img class="img-fluid d-block mx-auto" src="{{ asset('/img/products/'.$product->photo1) }}">
                                    </a>
                                </div>
                                <div class="product-name">
                                    <a href="{{ route('products.edit', $product->id ) }}">
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
</section>
@endsection
