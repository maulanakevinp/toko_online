@extends('layouts.admin')
@section('title','Edit Testimonial - Xylo Decoration')

@section('container')

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">Testimonials</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg">
            <!-- Error Handling -->
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('testimonials.update' , $testimonial->id) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $testimonial->name }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description">{{ $testimonial->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="{{ asset('img/testimonial/' . $testimonial->photo) }}" class="rounded-circle">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="Submit" class="btn btn-success btn-block">Edit Testimonial</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
