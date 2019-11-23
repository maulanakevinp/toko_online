@extends('layouts.admin')
@section('title')
Ubah Testimoni - {{ config('app.name') }}
@endsection
@section('container')

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">Testimoni</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Testimoni</li>
        </ol>
    </nav>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-body">
                    <form action="{{ route('testimonials.update' , $testimonial->id) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="nama">Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Name" value="{{ $testimonial->name }}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Description</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Description">{{ $testimonial->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{ asset('img/testimonial/' . $testimonial->photo) }}" class="img-fluid rounded-circle">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                        <label class="custom-file-label" for="foto">Pilih foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="Submit" class="btn btn-success btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
