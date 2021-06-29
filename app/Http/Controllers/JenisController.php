<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{

    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];


    public function getJenis()
    {
        $jeniss = Jenis::orderBy('nama_jenis','desc')->get();
        return view('masterbarang.jenis',compact(['jeniss']));
    }

    public function storeJenis(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required'
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis
        ]);

        return back()->with($this->pesan_create);
    }

    public function deleteJenis($id)
    {
        $jenis = Jenis::find($id);
        $jenis->delete();
        return back()->with($this->pesan_delete);
    }

    public function updateJenis(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required'
        ]);
        $jenis = Jenis::find($request->jenis_id);

        $jenis->update([
            'nama_jenis' => $request->nama_jenis
        ]);

        return back()->with($this->pesan_update);
    }
}
