@extends('layouts.admin')
@section('title','Edit Category - Xylo Decoration')

@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
        <div class="col-lg-6 mb-4">
            <form action="{{ route('categories.update' , $category->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="category" name="category" autocomplete="off" placeholder="Category Name" value="{{ $category->category }}">
                </div>
                <div class="input-group mb-3">
                    <img src="{{ asset('img/categories/' . $category->photo) }}" width="100%" height="250px">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo" aria-describedby="photo">
                        <label class="custom-file-label" for="photo">Choose photo</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block"> Edit Category </button>
            </form>
            <form action="{{ route('categories.destroy' , $category->id) }}" method="post" class="mt-3">
                @method('delete')
                @csrf
                <button class="btn btn-danger btn-block" type="submit" onclick="return confirm('Are you sure want to DELETE this type ?');">
                    Delete Category
                </button>
            </form>
        </div>
        <div class="col-lg-6">
            <a href="" class="btn btn-primary mb-3 addTypeModal" data-toggle="modal" data-target="#TypeModal">Add New Type</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Action</th>
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
                                <a href="" class="badge badge-success mb-3 editTypeModal" data-toggle="modal" data-target="#TypeModal" data-id="{{ $type->id }}" data-category="{{ $category->id }}">Edit</a>
                                <form action="{{ route('types.destroy' , $type->id ) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge badge-danger" type="submit" onclick="return confirm('Are you sure want to DELETE this type ?');">
                                        delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Type-->
<div class="modal fade" id="TypeModal" tabindex="-1" role="dialog" aria-labelledby="TypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TypeModalLabel">Add New Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="{{ route('types.store' , $category->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="type" name="type" placeholder="Type Name" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection
