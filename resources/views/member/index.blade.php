@extends('layouts.master')

@section('title')
    Daftar Member
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Member</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('member.store') }}')" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Tambah</button>
                    <button onclick="cetakMember('{{ route('member.cetak_member') }}')" class="btn btn-info btn-sm"><i class="fa fa-id-card-alt"></i> Cetak Kartu</button>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="form-member">
                        @csrf
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th width="7%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">NO</th>
                                <th width="5%">Kode</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th width="30%">Alamat</th>
                                <th width="20%">Action</th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('member.form')
@endsection

@push('scripts')
    <script>
        let table;

        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: "{{ route('member.data') }}"
                },
                columns: [
                    { data: 'select_all', searchable: false, sortable: false },
                    { data: 'DT_RowIndex', searchable: false, sortable: false },
                    { data: 'kode_member' },
                    { data: 'nama' },
                    { data: 'telepon' },
                    { data: 'alamat' },
                    { data: 'aksi', searchable: false, sortable: false },
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (! e.preventDefault()) {
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
            });

            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked)
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Member');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Member');

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

        function cetakMember(url) {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dicetak');
                return;
            } else {
                $('.form-member')
                    .attr('target', '_blank')
                    .attr('action', url)
                    .submit();
            }
        }
    </script>
@endpush
