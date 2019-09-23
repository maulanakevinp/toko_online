@extends('layouts.admin')
@section('title','Edit Password - Xylo Decoration')

@section('container')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow h-100">
                <div class="card-header">
                    <h5 class="m-0 pt-1 font-weight-bold text-black-50">Edit Password </h5>
                </div>
                <div class="card-body">
                    <form action=" {{ route('update-password', [ 'id' => Auth::user()->id ]) }} " method="post">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Password</label>
                            <input type="password" class="form-control  @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password1">New Password</label>
                            <input type="password" class="form-control  @error('new_password1') is-invalid @enderror" id="new_password1" name="new_password1">
                            @error('new_password1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password2">Repeat Password</label>
                            <input type="password" class="form-control  @error('new_password2') is-invalid @enderror" id="new_password2" name="new_password2">
                            @error('new_password2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
