@extends('layouts.master')

@section('title')
    Transaksi Pembelian
@endsection

@push('css')
<style>
    .tampil-bayar {
        font-size: 4em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 15px;
        background: #d1b7b7;
    }

    .table-pembelian tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaksi Pembelian</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table>
                        <tr>
                            <td>Supplier</td>
                            <td>: {{ $supplier->nama }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $supplier->telepon }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $supplier->alamat }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <label for="kode_produk" class="col-lg-2">Kode Produk </label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="hidden" name="id_produk" id="id_produk">
                                    <input type="hidden" name="id_pembelian" id="id_pembelian" value="{{ $id_pembelian }}">
                                    <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                    <div class="input-group-append">
                                        <button onclick="tampilProduk()" class="btn btn-outline-info" type="button" id="button-addon2"><i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-pembelian">
                        <thead>
                            <th width="7%">NO</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th width="20%">Action</th>
                        </thead>
                    </table>

                    <div class="row justify-content-end" style="margin-top: 20px">
                        <div class="col-8">
                            <div class="tampil-bayar bg-primary"></div>
                            <div class="tampil-terbilang"></div>
                        </div>
                        <div class="col-4">
                            <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="POST">
                                @csrf
                                <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">

                                <div class="form-group d-flex">
                                    <label for="totalrp" class="col-4 control-label">Total</label>
                                    <div class="col-8">
                                        <input type="text" id="totalrp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="diskon" class="col-4 control-label">Diskon</label>
                                    <div class="col-8">
                                        <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="bayar" class="col-4 control-label">Bayar</label>
                                    <div class="col-8">
                                        <input type="text" id="bayarrp" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
               <div class="row justify-content-end">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn-simpan" style="margin-top: -70px"><i class="fa fa-save"></i> Simpan Transaksi</button>
                    </div>
               </div>
            </div>
        </div>
    </div>

    @includeIf('pembelian_detail.produk')
@endsection

@push('scripts')
    <script>
        let table, table2;

        $(function() {
            table = $('.table-pembelian').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('pembelian_detail.data', $id_pembelian) }}",
                },
                columns: [
                    { data: 'DT_RowIndex', searchable: false, sortable: false },
                    { data: 'kode_produk' },
                    { data: 'nama_produk' },
                    { data: 'harga_beli' },
                    { data: 'jumlah' },
                    { data: 'subtotal' },
                    { data: 'aksi', searchable: false, sortable: false },
                ],
                dom: 'Brt',
                bSort: false,
            })
            .on('draw.dt', function () {
                loadForm($('#diskon').val());
            });
            table2 = $('.table-produk').DataTable();

            $(document).on('input', '.quantity', function () {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('jumlah jumlah tidak boleh lebih dari 1');
                    return;
                }

                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('jumlah jumlah tidak boleh lebih dari 10000');
                    return;
                }

                $.post(`{{ url('pembelian_detail') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah': jumlah
                })
                    .done(response => {
                        $(this).on('mouseout', function () {
                        table.ajax.reload();
                        })
                    })
                    .fail(errors => {
                        alert('tidak dapat menyimpan data');
                        return;
                    });
            });

            $(document).on('input', '#diskon', function () {
            if ($(this).val() == "") {
                $(this).val(0).select();
                }
                loadForm($(this).val());
            });

            $('.btn-simpan').on('click', function () {
                $('.form-pembelian').submit();
             });
        });

        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tambahProduk() {
            $.post("{{ route('pembelian_detail.store') }}", $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    table.ajax.reload();
                })
                .fail(errors => {
                    alert('tidak dapat menyimpan data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    })
            }
        }

        function loadForm(diskon = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/pembelian_detail/loadform') }}/${diskon}/${$('.total').text()}`)
                .done(response => {
                    $('#totalrp').val('Rp '+ response.totalrp);
                    $('#bayarrp').val('Rp '+ response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Rp. '+ response.bayarrp);
                    $('.tampil-terbilang').text('Rp. '+ response.terbilang);
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }
    </script>
@endpush
