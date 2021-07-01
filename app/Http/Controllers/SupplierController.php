<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];


    public function getSupplier()
    {
        $suppliers = Supplier::orderBy('nama','asc')->get();
        return view('suppliers',compact(['suppliers']));
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kontak' => 'required'
        ]);

        Supplier::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak
        ]);

        return back()->with($this->pesan_create);
    }

    public function updateSupplier(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kontak' => 'required'
        ]);

        $supplier = Supplier::find($request->supplier_id);
        $supplier->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak
        ]);

        return back()->with($this->pesan_update);
    }

    public function deleteSupplier($id)
    {
        Supplier::find($id)->delete();
        return back()->with($this->pesan_delete);
    }
}
