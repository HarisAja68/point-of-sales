@extends('layouts.master')

@section('title')
    Daftar Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Pembelian</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm()" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Transaksi Baru</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="7%">NO</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total Item</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th width="20%">Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('pembelian.supplier')
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                // processing: true,
                // autoWidth: false,
                // ajax: {
                //     url: "{{ route('supplier.data') }}"
                // },
                // columns: [
                //     { data: 'DT_RowIndex', searchable: false, sortable: false },
                //     { data: 'nama' },
                //     { data: 'telepon' },
                //     { data: 'alamat' },
                //     { data: 'aksi', searchable: false, sortable: false },
                // ]
            });
        });

        function addForm() {
            $('#modal-supplier').modal('show');
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Supplier');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=telepon]').val(response.telepon);
                    $('#modal-form [name=alamat]').val(response.alamat);
                })
                .fail((errors) => {
                    alert('tidak dapat menampilkan data');
                    return;
                })
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
    </script>
@endpush
