@extends('layouts.admin')
@section('title','Testimonials - Xylo Decoration')

@section('container')

<div class="testimonials-clean">
    <div class="container">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Testimonials</h1>
            <a href="" class="btn btn-primary mt-3 mb-0" data-toggle="modal" data-target="#newTestinonialModal">Add New Testinonial</a>

        </div>

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
        <div class="row people">
            @foreach ($testimonials as $testimonial)
                <div class="col-md-6 col-lg-4 item">
                    <div class="box">
                        <p class="description"><?= $testimonial['description'] ?></p>
                    </div>
                    <div class="author">
                        <img class="rounded-circle" src="{{ asset('img/testimonial/' . $testimonial->photo) }}">
                        <h5 class="name">{{ $testimonial->name }}</h5>
                        <a href="{{ route('testimonials.edit' , $testimonial->id) }}" class="badge badge-success">edit</a>
                        <form class="d-inline" action="{{ route('testimonials.destroy' , $testimonial->id) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="badge badge-danger " onclick="return confirm('Are you sure want to DELETE this testimonial ?');">delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newTestinonialModal" tabindex="-1" role="dialog" aria-labelledby="newTestinonialModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTestinonialModalLabel">Add New Testinonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('testimonials.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ old('name') }}">
                    </div>
                    <div class="form-group input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" name="photo" aria-describedby="photo">
                            <label class="custom-file-label" for="photo">Choose photo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea autocomplete="off" class="form-control" name="description" id="description" rows="3" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">Add </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
