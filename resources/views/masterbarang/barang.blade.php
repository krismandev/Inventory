@extends('layouts.master')
@section('title','Barang')
@section('page_title','Data Barang')
@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    {{session('success')}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah</a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <table class="table" id="data_barangs_reguler">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Kode Barang</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Minimum Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                <tr>
                    <th scope="row">{{$barang->nama_barang}}</th>
                    <td>{{$barang->kode_barang}}</td>
                    <td>{{$barang->harga_beli}}</td>
                    <td>{{$barang->harga_jual}}</td>
                    <td>{{number_format($barang->stok,0)}}</td>
                    <td>{{$barang->stok_minimal}}</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-edit"
                            data-barang_id="{{$barang->id}}"
                            data-nama_barang="{{$barang->nama_barang}}"
                            data-kode_barang="{{$barang->kode_barang}}"
                            data-harga_beli="{{$barang->harga_beli}}"
                            data-jenis_id="{{$barang->jenis_id}}"
                            data-nama_jenis="{{$barang->jenis->nama_jenis}}"
                            data-harga_jual="{{$barang->harga_jual}}"
                            data-stok="{{$barang->stok}}"
                            data-stok_minimal="{{$barang->stok_minimal}}"
                            data-toggle="modal"
                            data-target="#editModal">Edit</a>
                        <a href="#" class="btn btn-danger btn-hapus" data-barang_id="{{$barang->id}}">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>

        </div>
    </div>
</div>
@endsection
@section('linkfooter')
{{-- MODAL ADD --}}
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form class="form-horizontal form-label-left" action="{{route('storeBarang')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nama Barang</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="nama_barang" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Kode Barang</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="kode_barang" class="form-control" placeholder="" maxlength="6">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Jenis</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="jenis_id">
                            <option selected value="">Pilih jenis barang</option>
                            @foreach ($jeniss as $jenis)
                            <option value="{{$jenis->id}}">{{$jenis->nama_jenis}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Harga Beli</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" name="harga_beli" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Harga Jual</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" name="harga_jual" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Stok Minimal</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" name="stok_minimal" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
      </div>
    </div>
  </div>

  {{-- MODAL EDIT --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form class="form-horizontal form-label-left" action="{{route('updateBarang')}}" method="POST">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nama Barang</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="hidden" name="barang_id" id="edit_barang_id" value="">
                        <input type="text" name="nama_barang" id="edit_nama_barang" class="form-control" placeholder="" value="">
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Kode Barang</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="kode_barang" id="edit_kode_barang" value="" class="form-control" placeholder="" maxlength="6" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Jenis</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select class="form-control" name="jenis_id">
                            <option selected value="" id="edit_jenis_id">Pilih jenis barang</option>
                            @foreach ($jeniss as $jenis)
                            <option value="{{$jenis->id}}">{{$jenis->nama_jenis}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Harga Beli</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" name="harga_beli" id="edit_harga_beli" class="form-control" placeholder="" value="">
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Harga Jual</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" name="harga_jual" id="edit_harga_jual" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Stok saat ini</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" name="stok" id="edit_stok" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Stok Minimal</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="number" name="stok_minimal" id="edit_stok_minimal" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
      $('#data_barangs_reguler').DataTable();

        $(document).ready(function () {
            $(".btn-edit").click(function (e) {
                e.preventDefault();
                const barang_id = $(this).data('barang_id')
                const nama_barang = $(this).data('nama_barang')
                const kode_barang = $(this).data('kode_barang')
                const jenis_id = $(this).data('jenis_id')
                const nama_jenis = $(this).data('nama_jenis')
                const harga_beli = $(this).data('harga_beli')
                const harga_jual = $(this).data('harga_jual')
                const stok = $(this).data('stok')
                const stok_minimal = $(this).data('stok_minimal')

                $("#edit_barang_id").val(barang_id)
                $("#edit_nama_barang").val(nama_barang)
                $("#edit_kode_barang").val(kode_barang)
                $("#edit_jenis_id").val(jenis_id).html(nama_jenis)
                $("#edit_nama_jenis").val(nama_jenis)
                $("#edit_harga_beli").val(harga_beli)
                $("#edit_harga_jual").val(harga_jual)
                $("#edit_stok").val(stok)
                $("#edit_stok_minimal").val(stok_minimal)


            });
        });

        $(".btn-hapus").click(function (e) {
          e.preventDefault();
          const barang_id = $(this).data('barang_id')
          swal({
            title: "Yakin?",
            text: "Ingin menghapus item ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "barang/delete/"+barang_id
                }
            });
      });
  </script>
@endsection
