@extends('layouts.admin')
@section('title','Home Picture - Xylo Decoration')

@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800 mb-2">Slideshow</h1>
    <button class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#newImageModal">Tambah Gambar</button>

    <div class="row">
        @foreach ($company->images as $image)
        <div class="col-md-6 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <img class="mb-1" src="{{ asset('img/carousel/'. $image->image) }}" alt="{{ $image->image }}" width="100%" height="250px">
                    <form action="{{ route('destroy-home-picture' , ['id' => $image->id]) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block mb-1"
                            onclick="return confirm('Are you sure want to DELETE this picture ?');">Hapus foto</button>
                    </form>
                    <form action=" {{ route('update-home-picture' ,['id' => $image->id]) }} " method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="foto" required>
                                <label class="custom-file-label" for="foto">Pilih foto</label>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-sm" type="submit">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
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
            <form action="{{ route('add-home-picture') }}" method="post" enctype="multipart/form-data">
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
                    <button type="Submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection