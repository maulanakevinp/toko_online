@extends('layouts.admin')
@section('title','Dashbord Admin - Xylo Decoration')

@section('container')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div id="buttonShowPesananMasuk" class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pesanan Masuk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orderEntry }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div id="buttonShowPesananDalamProses" class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pesanan Dalam Proses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orderProcessed }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-truck fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div id="buttonShowPesananSelesai" class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan Selesai</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $orderFinished }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (request('halaman') == 'pesanan-masuk')
    <div class="card shadow h-100">
        <div class="card-header">
            <h5 class="m-0 pt-1 font-weight-bold text-black-50">Pesanan Masuk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID Pesanan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@if (request('halaman') == 'pesanan-dalam-proses')
    <div class="card shadow h-100">
        <div class="card-header">
            <h5 class="m-0 pt-1 font-weight-bold text-black-50">Pesanan Dalam Proses</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID Pesanan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@if (request('halaman') == 'pesanan-selesai')
    <div class="card shadow h-100">
        <div class="card-header">
            <h5 class="m-0 pt-1 font-weight-bold text-black-50">Pesanan Selesai</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>ID Pesanan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#buttonShowPesananMasuk').css('cursor','pointer');
        $('#buttonShowPesananMasuk').on('click',function () {
            window.location = "{{ url('/') }}/dashboard/?halaman=pesanan-masuk"
        });

        $('#buttonShowPesananDalamProses').css('cursor','pointer');
        $('#buttonShowPesananDalamProses').on('click',function () {
            window.location = "{{ url('/') }}/dashboard/?halaman=pesanan-dalam-proses"
        });

        $('#buttonShowPesananSelesai').css('cursor','pointer');
        $('#buttonShowPesananSelesai').on('click',function () {
            window.location = "{{ url('/') }}/dashboard/?halaman=pesanan-selesai"
        });

        var table = $('.dataTable').DataTable({
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Maaf - Tidak ada yang ditemukan",
                "info": "Tampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total kolom)",
                "emptyTable": "Tidak ada data di dalam tabel",
                "search": "Cari",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                }
            },
            "order": [[ 2, "desc" ]],
            processing: true,
            serverside: true,
            @if(request('halaman') == 'pesanan-masuk')
                ajax: "{{ route('ajax.get.order_entry') }}",
            @elseif(request('halaman') == 'pesanan-dalam-proses')
                ajax: "{{ route('ajax.get.order_processed') }}",
            @elseif(request('halaman') == 'pesanan-selesai')
                ajax: "{{ route('ajax.get.order_finished') }}",
            @endif
            columns: [
                {data:null},
                {data:'invoice', name:'invoice'},
                {data:'tanggal_pemesanan', name:'tanggal_pemesanan'},
                {data:'opsi', name :'opsi'},
            ],
        });
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
    });
</script>
@endsection