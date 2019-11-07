@extends('layouts.admin')
@section('title','Categories - Xylo Decoration')

@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">

    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categories</h1>
        <a href="" class="btn btn-primary mt-1" data-toggle="modal" data-target="#newCategoryModal">Add New Category</a>
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
    <div class="row justify-content-center">
        @foreach($categories as $category)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                <a href="{{ route('categories.edit', $category->id) }}" class="card-link">
                    <div class="card">
                        <img src="{{ asset('img/categories/'. $category->photo)  }}" class="card-img-top" style="height: 200px">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $category->category }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{ $categories->links() }}

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="newCategoryModal" tabindex="-1" role="dialog" aria-labelledby="newCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCategoryModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="category" name="category" autocomplete="off" placeholder="Category Name">
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" name="photo" aria-describedby="photo">
                            <label class="custom-file-label" for="photo">Choose photo</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Add </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
