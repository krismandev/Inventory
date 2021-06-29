<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getBarang()
    {
        $barangs = Barang::orderBy('kode_barang','asc')->get();
        return view("masterbarang.barang",compact(['barangs']));
    }
}
