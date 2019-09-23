@extends('layouts.admin')
@section('title','Company - Xylo Decoration')

@section('container')


<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Company</h1>
            
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
    </div>
    
    <form action=" {{ route('update-company', ['id' => $company->id]) }} " method="post">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold text-black-50">Edit Contact</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value=" {{ $company->name }} ">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value=" {{ $company->address }} ">
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value=" {{ $company->phone_number }} ">
                            @error('phone_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="whatsapp_number">WhatsApp Number</label>
                            <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value=" {{ $company->whatsapp_number }} ">
                            @error('whatsapp_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value=" {{ $company->email }} ">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold text-black-50">Edit Link</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="bukalapak">Bukalapak</label>
                            <input type="text" class="form-control @error('bukalapak') is-invalid @enderror" id="bukalapak" name="bukalapak" value=" {{ $company->bukalapak }} ">
                            @error('bukalapak')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tokopedia">Tokopedia</label>
                            <input type="text" class="form-control @error('tokopedia') is-invalid @enderror" id="tokopedia" name="tokopedia" value=" {{ $company->tokopedia }} ">
                            @error('tokopedia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="olx">OLX</label>
                            <input type="text" class="form-control @error('olx') is-invalid @enderror" id="olx" name="olx" value=" {{ $company->olx }} ">
                            @error('olx')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="whatsapp">WhatsApp</label>
                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value=" {{ $company->whatsapp }} ">
                            @error('whatsapp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="line">Line</label>
                            <input type="text" class="form-control @error('line') is-invalid @enderror" id="line" name="line" value="{{ $company->line }}">
                            @error('line')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold text-black-50">Edit Utilites</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Maps">Maps</label>
                            <textarea class="form-control @error('maps') is-invalid @enderror" name="maps" id="maps" rows="5">{{ $company->maps }}</textarea>
                            @error('maps')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="testimonial">Description Testimonial</label>
                            <textarea class="form-control @error('testimonial') is-invalid @enderror" name="testimonial" id="testimonial" rows="5">{{ $company->testimonial }}</textarea>
                            @error('testimonial')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description Company</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" >{{ $company->description }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success btn-block">Edit</button>
        </div>
    </form>

</div>
<!-- /.container-fluid -->

@endsection
