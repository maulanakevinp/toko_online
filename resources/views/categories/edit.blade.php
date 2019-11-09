@extends('layouts.admin')
@section('title')
Ubah Kategori - {{ config('app.name') }} 
@endsection
@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Kategori</li>
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
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold text-black-50">Kategori</h5>
                </div>
                <div class="card-body">
                <form action="{{ route('categories.update' , $category->id) }}" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="kategori" name="kategori" autocomplete="off" placeholder="Category Name" value="{{ $category->category }}">
                    </div>
                    <div class="input-group mb-3">
                        <img src="{{ asset('img/categories/' . $category->photo) }}" width="100%" height="250px">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="foto">
                            <label class="custom-file-label" for="foto">Pilih foto</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Ubah</button>
                </form>
                    <form class="d-inline-block float-right" action="{{ route('categories.destroy' , $category->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini ?');">
                            Hapus
                        </button>
                    </form>
                    <a class="btn btn-outline-secondary" href="{{ route('categories.index') }}"> Kembali</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold text-black-50 float-left">Jenis</h5>
                    <a href="" class="btn btn-primary btn-sm float-right addTypeModal" data-toggle="modal" data-target="#TypeModal" data-category="{{ $category->id }}">Tambah jenis baru</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $type)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $type->type }}
                                    </td>
                                    <td>
                                        <button class="badge badge-warning editTypeModal" data-toggle="modal" data-target="#TypeModal" data-id="{{ $type->id }}" data-category="{{ $category->id }}" data-toggle="tooltip" title="Ubah"><i class="fas fa-edit"></i></button>
                                        <form class="d-inline-block" action="{{ route('types.destroy' , ['id' => $type->id, 'category' => $category->id ]) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge badge-danger " type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus jenis ini ?');" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Type-->
<div class="modal fade" id="TypeModal" tabindex="-1" role="dialog" aria-labelledby="TypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TypeModalLabel">Tambah Jenis Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="{{ route('types.store' , $category->id) }}" method="post">
                @csrf
                <input id="method-type" type="hidden" name="_method" value="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="Submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.addTypeModal').on('click', function () {
        $('#TypeModalLabel').html('Tambah Jenis Baru');
        const category = $(this).data('category');
        $('.modal-footer button[type=submit]').html('Tambah');
        $('#form').attr('action', "{{ url('types') }}/" + category);
        $('#method-type').val('post');
    });
    $('.editTypeModal').on('click', function () {
        const id = $(this).data('id');
        const category = $(this).data('category');
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#TypeModalLabel').html('Ubah Jenis');
        $('.modal-footer button[type=submit]').html('Ubah');
        $('#form').attr('action', "{{ url('types') }}/" + id + "/" + category);
        $('#method-type').val('patch');

        $.ajax({
            url: "{{ route('get-type') }}",
            data: {
                _token: CSRF_TOKEN,
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#type').val(data.type);
            }
        });
    });
});
</script>
@endsection
