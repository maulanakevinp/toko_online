@extends('layouts.admin')
@section('title')
Ubah Produk - {{ config('app.name')}}
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
                                <label for="nama">Nama</label> <label class="text-danger">*</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" autocomplete="off" value="{{ old('name',$product->name) }}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="harga">Harga</label> <label class="text-danger">*</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" autocomplete="off" value="{{ old('harga',$product->price) }}">
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="stok">Stok</label> <label class="text-danger">*</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" autocomplete="off" value="{{ old('stok',$product->stock) }}">
                                @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kategori">Kategori</label> <label class="text-danger">*</label>
                                <select id="kategori" name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                    @if($product->type->category_id == $category->id)
                                        <option selected="selected" value="{{ $category->id }}">{{ $category->category }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jenis">Jenis</label> <label class="text-danger">*</label>
                                <select id="jenis" name="jenis" class="form-control @error('jenis') is-invalid @enderror"></select>
                                @error('jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="bukalapak">Bukalapak</label>
                                <input type="text" class="form-control @error('bukalapak') is-invalid @enderror" name="bukalapak" autocomplete="off" value="{{ old('bukalapak',$product->bukalapak) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tokopedia">Tokopedia</label>
                                <input type="text" class="form-control @error('tokopedia') is-invalid @enderror" name="tokopedia" autocomplete="off" value="{{ old('tokopedia',$product->tokopedia) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="olx">OLX</label>
                                <input type="text" class="form-control @error('olx') is-invalid @enderror" name="olx" autocomplete="off" value="{{ old('olx',$product->olx) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class=" form-group col-md">
                                <label for="deskripsi">Deksripsi</label> <label class="text-danger">*</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="5">{{ old('deskripsi',$product->description) }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class=" form-group col-md">
                                <label for="specification">Spesifikasi</label>
                                <textarea class="form-control @error('specification') is-invalid @enderror" name="specification" id="specification" rows="5">{{ old('specification',$product->specification) }}</textarea>
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
                <h5 class="font-weight-bold d-inline-block m-0">Foto</h5>
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
                                        <input type="file" class="custom-file-input" id="foto" name="foto"
                                            aria-describedby="foto" required>
                                        <label class="custom-file-label" for="foto">Pilih foto</label>
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
                            <input type="file" class="custom-file-input" id="foto" name="foto"
                                aria-describedby="foto">
                            <label class="custom-file-label" for="foto">Pilih gambar</label>
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
    CKEDITOR.replace( 'deskripsi' );
    CKEDITOR.replace( 'specification' );
    let cat_id = $('#kategori').val();
    let type = @json($product->type_id);
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    if (cat_id != '') {
        $.ajax({
            url: "{{ route('get-types') }}",
            type: 'post',
            data: {
                _token: CSRF_TOKEN,
                id: cat_id,
                type: type
            },
            success: function(data) {
                $("#jenis").html(data);
            }
        });
    } else {
        $("#jenis").html('<option value="">Pilih Jenis</option>');
    }
    $(document).ready(function () {
        $("#kategori").on("change", function() {
            let category_id = $(this).val();
            if (category_id != '') {
                $.ajax({
                    url: "{{ route('get-types') }}",
                    type: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        id: category_id
                    },
                    success: function(data) {
                        $("#jenis").html(data);
                    }
                });
            } else {
                $("#jenis").html('<option value="">Pilih Jenis</option>');
            }
        });
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