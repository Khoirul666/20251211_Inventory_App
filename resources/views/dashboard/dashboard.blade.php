@extends('layout.main')

@section('bredcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('kontainer')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Karyawan  -->
    <!-- ============================================================== -->
    @if(Auth::check())
    @if(Auth::user()->role==='karyawan')
    <div class="row">
        <!-- Column -->
        <a class="col-md-6 col-lg-4 col-xlg-3" href="{{url('kategori')}}">
            <div class="card card-hover">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white">
                        <i class="fas fa-clipboard-list"></i>
                    </h1>
                    <h6 class="text-white">Kategori</h6>
                </div>
            </div>
        </a>
        <!-- Column -->
        <a class="col-md-6 col-lg-4 col-xlg-3" href="{{url('barang')}}">
            <div class="card card-hover">
                <div class="box bg-secondary text-center">
                    <h1 class="font-light text-white">
                        <i class="mdi mdi-cube"></i>
                    </h1>
                    <h6 class="text-white">Barang</h6>
                </div>
            </div>
        </a>
        <!-- Column -->
        <a class="col-md-6 col-lg-4 col-xlg-3" href="{{url('customer')}}">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white">
                        <i class="fas fa-shopping-cart"></i>
                    </h1>
                    <h6 class="text-white">Customer</h6>
                </div>
            </div>
        </a>
        <!-- Column -->
        <a class="col-md-6 col-lg-4 col-xlg-3" href="{{url('supplier')}}">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white">
                        <i class="fas fa-truck"></i>
                    </h1>
                    <h6 class="text-white">Supplier</h6>
                </div>
            </div>
        </a>
        <!-- Column -->
        <a class="col-md-6 col-lg-4 col-xlg-3" href="{{url('barang_keluar')}}">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white">
                        <i class="fas fa-sign-out-alt"></i>
                    </h1>
                    <h6 class="text-white">Barang Keluar</h6>
                </div>
            </div>
        </a>
        <!-- Column -->
        <a class="col-md-6 col-lg-4 col-xlg-3" href="{{url('barang_masuk')}}">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white">
                        <i class="fas fa-sign-in-alt"></i>
                    </h1>
                    <h6 class="text-white">Barang Masuk</h6>
                </div>
            </div>
        </a>
    </div>
    @endif
    @if(Auth::user()->role==='pemilik')
    <!-- ============================================================== -->
    <!-- Pemilik  -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <a class="col-md-6 col-lg-4 col-xlg-3" href="{{url('laporan_stok_barang')}}">
            <div class="card card-hover">
                <div class="box bg-primary text-center">
                    <h1 class="font-light text-white">
                        <i class="fas fa-clipboard-list"></i>
                    </h1>
                    <h6 class="text-white">Laporan Stok Barang</h6>
                </div>
            </div>
        </a>
    </div>
    @endif
    @endif
</div>
@endsection