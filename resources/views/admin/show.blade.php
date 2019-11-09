@extends('layouts.admin')
@section('title')
{{ $title }} - {{ config('app.name') }}
@endsection
@section('container')


<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil Saya</h1>
</div>

    <div class="card mb-3 col-lg-8 p-0">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('img/profile/' . Auth::user()->photo) }}" class="card-img" alt="{{ Auth::user()->photo }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"> {{ Auth::user()->name }} </h5>
                    <p class="card-text"> {{ Auth::user()->email }} </p>
                    <a href=" {{ route('edit-profile') }} " class="btn btn-warning btn-sm">Ubah</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
