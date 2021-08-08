@extends('layouts.master')

@section('title')
    Daftar Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('kategori.store') }}')" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Tambah</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="10%">NO</th>
                            <th>Nama Kategori</th>
                            <th width="20%">Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('kategori.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('kategori.data') }}"
                },
                columns: [{ data: 'DT_RowIndex', searchable: false, sortable: false },
                    { data: 'nama_kategori' },
                    { data: 'aksi', searchable: false, sortable: false },
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            })
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Kategori');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama_kategori]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Kategori');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_kategori]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_kategori]').val(response.nama_kategori);
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
