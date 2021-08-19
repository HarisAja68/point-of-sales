@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Default box -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <h1>Selamat Datang</h1>
                    <h2>Anda Login Sebagai Kasir</h2>
                    <br><br>
                    <a href="{{ route('transaksi.baru') }}" class="btn btn-info btn-lg">Transaksi Baru</a>
                    <br><br><br>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.card -->
@endsection
