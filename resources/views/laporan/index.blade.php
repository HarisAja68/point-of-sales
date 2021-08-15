@extends('layouts.master')

@section('title')
    Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal) }} s/d {{ tanggal_indonesia($tanggalAkhir) }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('template') }}/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
@endpush
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Pendapatan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="updatePeriode()" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Ubah Periode</button>
                    <a href="{{ route('laporan.eksport_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak Laporan</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="7%">NO</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pembelian</th>
                            <th>Pengeluaran</th>
                            <th>Pendapatan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('laporan.form')
@endsection

@push('scripts')
<script src="{{ asset('template') }}/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}"
                },
                columns: [
                    { data: 'DT_RowIndex', searchable: false, sortable: false },
                    { data: 'tanggal' },
                    { data: 'penjualan' },
                    { data: 'pembelian' },
                    { data: 'pengeluaran' },
                    { data: 'pendapatan' },
                ],
                dom: 'Brt',
                bSort: false,
                bPaginate: false,
            });

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            });
        });

        function updatePeriode() {
            $('#modal-form').modal('show');

        }
    </script>
@endpush
