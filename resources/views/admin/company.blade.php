@extends('layouts.admin')
@section('title','Perusahaan - Xylo Decoration')

@section('container')


<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perusahaan</h1>
    </div>
    
    <form action=" {{ route('update-company', ['id' => $company->id]) }} " method="post">
        @method('patch')
        @csrf
        <div class="row mb-3">
            <div class="col-lg-6 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold text-black-50">Ubah Kontak</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan',$company->name) }}">
                            @error('nama_perusahaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat',$company->address) }}">
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon',$company->phone_number) }}">
                            @error('nomor_telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_whatsapp">Nomor Whatsapp</label>
                            <input type="text" class="form-control @error('nomor_whatsapp') is-invalid @enderror" id="nomor_whatsapp" name="nomor_whatsapp" value="{{ old('nomor_whatsapp',$company->whatsapp_number) }}">
                            @error('nomor_whatsapp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$company->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold text-black-50">Ubah Link</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="bukalapak">Bukalapak</label>
                            <input type="text" class="form-control @error('bukalapak') is-invalid @enderror" id="bukalapak" name="bukalapak" value="{{ old('bukalapak',$company->bukalapak) }}">
                            @error('bukalapak')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tokopedia">Tokopedia</label>
                            <input type="text" class="form-control @error('tokopedia') is-invalid @enderror" id="tokopedia" name="tokopedia" value="{{ old('tokopedia',$company->tokopedia) }}">
                            @error('tokopedia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="olx">OLX</label>
                            <input type="text" class="form-control @error('olx') is-invalid @enderror" id="olx" name="olx" value="{{ old('olx',$company->olx) }}">
                            @error('olx')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="whatsapp">WhatsApp</label>
                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ old('whatsapp',$company->whatsapp) }}">
                            @error('whatsapp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="line">Line</label>
                            <input type="text" class="form-control @error('line') is-invalid @enderror" id="line" name="line" value="{{ old('line',$company->line) }}">
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
        <div class="card shadow h-100 mb-3">
            <div class="card-header">
                <h5 class="m-0 pt-1 font-weight-bold text-black-50">Ubah Rekening</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="rekening_bca">Rekening BCA</label>
                            <input type="text" class="form-control @error('rekening_bca') is-invalid @enderror" id="rekening_bca" name="rekening_bca" value="{{ old('rekening_bca',$company->bca)}} ">
                            @error('rekening_bca')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="rekening_bni">Rekening BNI</label>
                            <input type="text" class="form-control @error('rekening_bni') is-invalid @enderror" id="rekening_bni" name="rekening_bni" value="{{ old('rekening_bni',$company->bni) }}">
                            @error('rekening_bni')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg">
                <div class="card shadow h-100">
                    <div class="card-header">
                        <h5 class="m-0 pt-1 font-weight-bold text-black-50">Ubah Utilitas</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Maps">Maps</label> <a target="_blank" href="{{ asset('video/tutorial_maps.mp4') }}">Tutorial klik disini</a>
                            <textarea class="form-control @error('maps') is-invalid @enderror" name="maps" id="maps" rows="5">{{ old('maps',$company->maps) }}</textarea>
                            @error('maps')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_testimoni">Deskripsi Testimoni</label>
                            <textarea class="form-control @error('deskripsi_testimoni') is-invalid @enderror" name="deskripsi_testimoni" id="deskripsi_testimoni" rows="5">{{ old('deskripsi_testimoni',$company->testimonial) }}</textarea>
                            @error('deskripsi_testimoni')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_perusahaan">Deskripsi Perusahaan</label>
                            <textarea class="form-control @error('deskripsi_perusahaan') is-invalid @enderror" name="deskripsi_perusahaan" id="deskripsi_perusahaan" rows="5" >{{ old('deskripsi_perusahaan',$company->description) }}</textarea>
                            @error('deskripsi_perusahaan')
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
            <button type="submit" class="btn btn-success btn-block">Simpan</button>
        </div>
    </form>

</div>
<!-- /.container-fluid -->

@endsection
