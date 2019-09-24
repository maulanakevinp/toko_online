@extends('layouts.admin')
@section('title')
Add Product - Xylo Decoration
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg">
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
            <div class="card">
                <div class="card-body">
                    <form action=" {{ route('products.store') }} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label> <label class="text-danger">*</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label> <label class="text-danger">*</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" autocomplete="off" value="{{ old('price') }}">
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
                                <select id="category" name="category" class="form-control @error('category') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="<?= $category->id ?>"><?= $category->category ?></option>
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
                                <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="">Select Type</option>
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
                                <input type="text" class="form-control" name="bukalapak" autocomplete="off" value="{{ old('bukalapak') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tokopedia">Tokopedia</label>
                                <input type="text" class="form-control" name="tokopedia" autocomplete="off" value="{{ old('tokopedia') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="olx">OLX</label>
                                <input type="text" class="form-control" name="olx" autocomplete="off" value="{{ old('olx') }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class=" form-group col-md">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label> Photo </label> <label class="text-danger">*</label>
                        </div>
                        <div class="form-row">
                            @for ($i = 1; $i <= 6; $i++)
                            <div class="input-group col-md-6 mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo{{ $i }}" name="photo{{ $i }}" aria-describedby="photo">
                                    <label class="custom-file-label" for="photo">Choose photo</label>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="form-group  ">
                            <button type="submit" class="btn btn-primary btn-block">
                                Add New Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection