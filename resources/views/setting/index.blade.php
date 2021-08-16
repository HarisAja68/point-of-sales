@extends('layouts.master')

@section('title')
    Setting
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Setting</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('setting.update') }}" method="POST" class="form-setting" data-toggle="validator" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            <strong>Berhasil!</strong> Perubahan berhasil disimpan.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="form-group row">
                            <label for="nama_perusahaan" class="col-md-3 control-label">Nama Perusahaan</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-md-3 control-label">Telepon</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="telepon" id="telepon" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-3 control-label">Alamat</label>
                            <div class="col-md-6">
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="path_logo" class="col-md-3 control-label">Logo Perusahaan</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="path_logo" id="path_logo" onchange="preview('.tampil-logo', this.files[0])">
                                <span class="help-block with-errors"></span>
                                <br>
                                <div class="tampil-logo"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="path_kartu_member" class="col-md-3 control-label">Kartu Member</label>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="path_kartu_member" id="path_kartu_member"  onchange="preview('.tampil-kartu-member', this.files[0], 300)">
                                <span class="help-block with-errors"></span>
                                <br>
                                <div class="tampil-kartu-member"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diskon" class="col-md-3 control-label">Diskon (%)</label>
                            <div class="col-md-3">
                                <input type="number" class="form-control" name="diskon" id="diskon" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tipe_nota" class="col-md-3 control-label">Tipe Nota</label>
                            <div class="col-md-3">
                                <select class="form-control" name="tipe_nota" id="tipe_nota" required>
                                    <option value="1">Nota Kecil</option>
                                    <option value="2">Nota Besar</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            showData();

            $('.form-setting').validator().on('submit', function(e) {
                if (! e.preventDefault()) {
                    $.ajax({
                        url: $('.form-setting').attr('action'),
                        type: $('.form-setting').attr('method'),
                        data: new FormData($('.form-setting')[0]),
                        async: false,
                        processData: false,
                        contentType: false
                    })
                    .done(response => {
                        showData();
                        $('.alert').fadeIn();

                        setTimeout(() => {
                            $('.alert').fadeOut();
                        }, 5000);
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
                }
            });
        });

        function showData() {
            $.get('{{ route('setting.show') }}')
                .done(response => {
                    $('[name=nama_perusahaan]').val(response.nama_perusahaan);
                    $('[name=telepon]').val(response.telepon);
                    $('[name=alamat]').val(response.alamat);
                    $('[name=diskon]').val(response.diskon);
                    $('[name=tipe_nota]').val(response.tipe_nota);

                    $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                    $('.tampil-kartu-member').html(`<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }
    </script>
@endpush
