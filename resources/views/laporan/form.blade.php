<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('laporan.index') }}" method="get" method="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Periode Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tanggal_awal" class="col-md-4 col-md-offset-1 control-label">Tanggal Awal</label>
                        <div class="col-md-8">
                            <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control datepicker" value="{{ request('tanggal_awal') }}" required autofocus>
                            <div class="help-block with-errors"></div>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_akhir" class="col-md-4 col-md-offset-1 control-label">Tanggal Akhir</label>
                        <div class="col-md-8">
                            <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control datepicker" value="{{ request('tanggal_akhir') }}" required>
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
