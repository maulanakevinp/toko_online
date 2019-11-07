@extends('layouts.admin')
@section('title')
Edit Product - {{ config('app.name')}}
@endsection

@section('container')
<!-- Begin Page Content -->

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Produk</li>
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
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <form action=" {{ route('products.update', ['id' => $product->id]) }} " method="post">
                        @method('patch')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama</label> <label class="text-danger">*</label>
                                <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $product->name }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Harga</label> <label class="text-danger">*</label>
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
                                <label for="category">Kategori</label> <label class="text-danger">*</label>
                                <select id="category" name="category" class="form-control">
                                    <option value="">Pilih kategori</option>
                                    @foreach ($categories as $category)
                                    @if($product->type->category_id == $category->id)
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
                                <select id="type" name="type" class="form-control">
                                    <option selected="selected" value="{{ $product->type_id }}">{{ $product->type->type }}</option>
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
                                <label for="description">Deksripsi</label> <label class="text-danger">*</label>
                                <textarea class="form-control" name="description" id="description" rows="5">{{ $product->description }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class=" form-group col-md">
                                <label for="specification">Spesifikasi</label> <label class="text-danger">*</label>
                                <textarea class="form-control" name="specification" id="specification" rows="5">{{ $product->specification }}</textarea>
                                @error('specification')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">
                                Ubah produk
                            </button>
                        </div>
                    </form>
                    <form class="mt-2" action="{{ route('products.destroy', $product->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus produk ini ?');">Hapus Produk</button>
                    </form>
                </div>
            </div>
            <div class="mb-3">
                <h5 class="font-weight-bold d-inline-block">Foto </h5>
                <button id="addImageField" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#newImageModal" type="button"><i class="fas fa-file-image"></i>Tambah foto baru</button>
            </div>
            <div class="row">
                @foreach ($product->images as $image)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <img class="mb-1" src="{{ asset('img/products/'. $image->image) }}" alt="{{ $image->image }}"
                                width="100%" height="250px">
                            <form action="{{ route('destroy_product_image' , ['id' => $image->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-block mb-1" onclick="return confirm('Apakah anda yakin ingin menghapus foto ini ?');">Hapus foto</button>
                            </form>
                            <form action=" {{ route('update_product_image' ,['id' => $image->id]) }} " method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image"
                                            aria-describedby="image" required>
                                        <label class="custom-file-label" for="image">Pilih foto</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-sm" type="submit">Unggah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>            
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="newImageModal" tabindex="-1" role="dialog" aria-labelledby="newTestinonialModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTestinonialModalLabel">Tambah Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('add_product_image',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image"
                                aria-describedby="image">
                            <label class="custom-file-label" for="image">Pilih gambar</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="Submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('script')
<script>
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'specification' );
    $(document).ready(function () {
        $(".btn-success").click(function () {
            var html = $(".clone").html();
            $(".increment").after(html);
        });
        $("body").on("click", ".btn-danger", function () {
            $(this).parents(".control-group").remove();
        });
    });
</script>
@endsection