<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::orderBy('nama_produk')->get();
        $supplier = Supplier::find(session('id_supplier'));

        if (!$supplier) {
            abort(404);
        }

        return view('pembelian_detail.index', compact('id_pembelian', 'produk', 'supplier'));
    }

    public function data($id)
    {
        $detail = PembelianDetail::with('produk')
            ->where('id_pembelian', $id)
            ->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk['nama_produk'];
            })
            ->addColumn('kode_produk', function ($detail) {
                return $detail->produk['kode_produk'];
            })
            ->addColumn('aksi', function ($detail) {
                return '
                    <button type="button" onclick="deleteData(`' . route('pembelian_detail.destroy', $detail->id_pembelian_detail) . '`)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        if (!$produk) {
            return response()->json('data gagal disimpan', 400);
        }

        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('data berhasil disimpan', 200);
    }
}
