<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Jenis;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];



    public function getBarang()
    {
        $barangs = Barang::orderBy('kode_barang','asc')->get();
        $jeniss = Jenis::orderBy('nama_jenis','asc')->get();
        return view("masterbarang.barang",compact(['barangs','jeniss']));
    }

    public function storeBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|max:6|unique:barangs,kode_barang',
            'jenis_id' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok_minimal' => 'required'
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'jenis_id' => $request->jenis_id,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok_minimal' => $request->stok_minimal
        ]);

        return back()->with($this->pesan_create);
    }

    public function updateBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_id' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok_minimal' => 'required',
        ]);

        $barang = Barang::find($request->barang_id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jenis_id' => $request->jenis_id,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
            'stok_minimal' => $request->stok_minimal,
        ]);

        return back()->with($this->pesan_update);
    }

    public function deleteBarang($id)
    {
        Barang::find($id)->delete();
        return back()-with($this->pesan_delete);
    }
}
