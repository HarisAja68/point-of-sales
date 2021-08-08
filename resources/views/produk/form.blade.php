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
                        <label for="nama_produk" class="col-md-4 col-md-offset-1 control-label">Nama Produk</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" required
                                autofocus>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kategori" class="col-md-4 col-md-offset-1 control-label">ID Kategori</label>
                        <div class="col-md-8">
                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merk" class="col-md-4 col-md-offset-1 control-label">Merk</label>
                        <div class="col-md-8">
                            <input type="text" name="merk" id="merk" class="form-control">
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_beli" class="col-md-4 col-md-offset-1 control-label">Harga Beli</label>
                        <div class="col-md-8">
                            <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_jual" class="col-md-4 col-md-offset-1 control-label">Harga Jual</label>
                        <div class="col-md-8">
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-md-4 col-md-offset-1 control-label">Diskon</label>
                        <div class="col-md-8">
                            <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stok" class="col-md-4 col-md-offset-1 control-label">Stok</label>
                        <div class="col-md-8">
                            <input type="number" name="stok" id="stok" class="form-control" required value="0">
                            {{-- <span class="invalid-feedback" role="alert"></span> --}}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-primary btn-sm">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
