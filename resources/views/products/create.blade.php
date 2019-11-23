@extends('layouts.admin')
@section('title')
Tambah Produk - {{ config('app.name')}}
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
    <div class="row mb-5">
        <div class="col-lg">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action=" {{ route('products.store') }} " method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Nama</label> <label class="text-danger">*</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" autocomplete="off" value="{{ old('nama') }}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="harga">Harga</label> <label class="text-danger">*</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" autocomplete="off" value="{{ old('harga') }}">
                                @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="stok">Stok</label> <label class="text-danger">*</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" autocomplete="off" value="{{ old('stok') }}">
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
                                        @if (old('kategori') == $category->id)
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
                                <select id="jenis" name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                    <option value="">Pilih Jenis</option>
                                </select>
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
                                <label for="deskripsi">Deskripsi</label> <label class="text-danger">*</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="5">{{ old('deskripsi') }}</textarea>
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
                                <textarea class="form-control @error('specification') is-invalid @enderror" name="specification" id="specification"
                                    rows="5">{{ old('specification','<div class="table-responsive">
                                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td>Tinggi</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Panjang</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Berat</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>') }}</textarea>
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
                            <input type="file" name="foto[]" class="form-control" multiple>
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
    CKEDITOR.replace( 'deskripsi' );
    CKEDITOR.replace( 'specification' );
    $(document).ready(function(){
        $("#kategori").on("change", function() {
            const category_id = $(this).val();
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
    });
</script>
@endsection