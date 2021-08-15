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
                        <label for="name" class="col-md-4 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" required autofocus>
                            <div class="help-block with-errors"></div>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-md-offset-1 control-label">Email</label>
                        <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control" required>
                            <div class="help-block with-errors"></div>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-md-offset-1 control-label">Password</label>
                        <div class="col-md-8">
                            <input type="password" name="password" id="password" class="form-control" required minlength="6">
                            <div class="help-block with-errors"></div>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-4 col-md-offset-1 control-label">Konfirmasi Passoword</label>
                        <div class="col-md-8">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required data-match="#password">
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
