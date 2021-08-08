<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-lg">
        <form action="" method="POST" method="form-horizontal">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                            <div class="help-block with-errors"></div>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telepon" class="col-md-4 col-md-offset-1 control-label">Telepon</label>
                        <div class="col-md-8">
                            <input type="text" name="telepon" id="telepon" class="form-control" required>
                            <div class="help-block with-errors"></div>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-md-offset-1 control-label">Alamat</label>
                        <div class="col-md-8">
                            <div class="form-floating">
                                <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            </div>
                            <div class="help-block with-errors"></div>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
