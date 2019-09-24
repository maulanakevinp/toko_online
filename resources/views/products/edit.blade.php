@extends('layouts.admin')
@section('title')
Edit Product - Xylo Decoration
@endsection

@section('container')
<!-- Begin Page Content -->

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg">
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <div class="card mb-3">
                <div class="card-body">
                    <form action=" {{ route('products.update', ['id' => $product->id]) }} " method="post">
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label> <label class="text-danger">*</label>
                                <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $product->name }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label> <label class="text-danger">*</label>
                                <input type="number" class="form-control" name="price" autocomplete="off" value="{{ $product->price }}">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="category">Category</label> <label class="text-danger">*</label>
                                <select id="category" name="category" class="form-control">
                                    <option value=" {{ $product->category_id }} ">{{ $product->category }}</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Type</label> <label class="text-danger">*</label>
                                <select id="type" name="type" class="form-control">
                                    <option value=" {{ $product->type_id }} "> {{ $product->type }} </option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="bukalapak">Bukalapak</label>
                                <input type="text" class="form-control" name="bukalapak" autocomplete="off" value="{{ $product->bukalapak }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tokopedia">Tokopedia</label>
                                <input type="text" class="form-control" name="tokopedia" autocomplete="off" value="{{ $product->tokopedia }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="olx">OLX</label>
                                <input type="text" class="form-control" name="olx" autocomplete="off" value="{{ $product->olx }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class=" form-group col-md">
                                <label for="description">Description</label> <label class="text-danger">*</label>
                                <textarea class="form-control" name="description" id="description" rows="5">{{ $product->description }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">
                                Edit Product
                            </button>
                        </div>
                    </form>
                    <form class="mt-2" action="{{ route('products.destroy', $product->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure want to DELETE this product ?');">Delete Product</button>
                    </form>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-body">
                    <div>
                        <label> Photo </label> <label class="text-danger">*</label>
                        @error('photo1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <img class="mb-1" src="{{ asset('img/products/'. $product->photo1) }}" alt="{{ $product->photo1 }}" width="100%" height="250px">
                            <form action=" {{ route('update-product-picture' ,['id' => $product->id , 'photo' => $product->photo1]) }} " method="post" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photo1" name="photo1" aria-describedby="photo1">
                                        <label class="custom-file-label" for="photo1">Choose photo</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success btn-sm" type="submit">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @for ($i = 2; $i <= 6; $i++)
                        @php
                            $p = 'photo'.$i;
                        @endphp
                        <div class="col-md-6 mb-3">
                            @if (!empty($photo->$p))
                            <img class="mb-1" src="{{ asset('img/products/'. $photo->$p)  }}" width="100%" height="250px" alt=" {{ $photo->$p }} ">
                            <form action="{{ route('destroy-product-picture', ['id' => $product->id , 'photo' => $p]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block mb-1" onclick="return confirm('Are you sure want to DELETE this photo ?');">Delete Photo</button>
                            </form>
                            @else
                            <img class="mb-1" src="{{ asset('img/noimage.jpg') }}" width="100%" height="250px">
                            @endif
                            <form action="{{ route('update-product-picture' ,['id' => $product->id , 'photo' => $p ]  ) }}" method="post" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="input-group ">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="{{ $p }}" name="{{ $p }}" aria-describedby="{{ $p }}">
                                        <label class="custom-file-label" for="{{ $p }}">Choose photo</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success btn-sm" type="submit">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection