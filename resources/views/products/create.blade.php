@extends('layouts.admin')
@section('title')
Add Product - {{ config('app.name')}}
@endsection

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah produk baru</li>
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
                                <label for="name">Nama</label> <label class="text-danger">*</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Harga</label> <label class="text-danger">*</label>
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
                                <label for="category">Kategori</label> <label class="text-danger">*</label>
                                <select id="category" name="category" class="form-control @error('category') is-invalid @enderror">
                                    <option value="">Pilih kategori</option>
                                    @foreach ($categories as $category)
                                        @if (old('category') == $category->id)
                                            <option selected="selected" value="{{ $category->id }}">{{ $category->category }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Tipe</label> <label class="text-danger">*</label>
                                <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="">Pilih tipe</option>
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
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class=" form-group col-md">
                                <label for="specification">Spesifikasi</label>
                                <textarea class="form-control @error('specification') is-invalid @enderror" name="specification" id="specification"
                                    rows="5">{{ old('specification') }}</textarea>
                                @error('specification')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label> Foto </label> <label class="text-danger">*</label>
                        </div>
                        <div class="form" id="fieldImage">
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                        <div class="form-group mt-3 ">
                            <button type="submit" class="btn btn-primary btn-block">
                                Tambah produk baru
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
@section('script')
<script>
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'specification' );
    // $(document).ready(function () {
    //     $("#addImageField").click(function () {
    //         var html = `
    //             <div class="clone col-md-6 control-group input-group mb-3">
    //                 <input type="file" name="filename[]" class="form-control">
    //                 <div class="input-group-btn">
    //                     <button class="btn btn-danger remove" type="button">Hapus</button>
    //                 </div>
    //             </div>`;
    //         $("#fieldImage").append(html);
    //     });
    //     $("body").on("click", ".remove", function () {
    //         $(this).parents(".clone").remove();
    //     });
    // });
</script>
@endsection