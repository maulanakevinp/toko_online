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
                                    @if (str_replace('-',' ',Request::segment(3)) == strtolower($category->category))
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
                                    @if ($type->type == $title)
                                    <option selected value="{{ $type->id }}">{{ $type->type }}</option>
                                    @else
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="products">
                            <div class="row no-gutters">
                                @foreach ($products as $product)                                        
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="clean-product-item">
                                        <div class="image">
                                            <a href="{{ route('details-product', ['id' => $product->id, 'name' => strtolower(str_replace(' ','-',$product->name))] )}}">
                                                <img class="img-fluid d-block mx-auto" src="{{ asset('/img/products/'.$product->photo1) }}">
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
