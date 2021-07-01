@extends('layouts.master')
@section('title','supplier')
@section('page_title','Data Supplier')
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

          <table class="table" id="data_suppliers_reguler">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kontak</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <th scope="row">{{$supplier->nama}}</th>
                    <td>{{$supplier->alamat}}</td>
                    <td>{{$supplier->kontak}}</td>
                    <td>
                        <a href="#" class="btn btn-warning btn-edit"
                            data-supplier_id="{{$supplier->id}}"
                            data-nama="{{$supplier->nama}}"
                            data-alamat="{{$supplier->alamat}}"
                            data-kontak="{{$supplier->kontak}}"
                            data-toggle="modal"
                            data-target="#editModal">Edit</a>
                        <a href="#" class="btn btn-danger btn-hapus" data-supplier_id="{{$supplier->id}}">Hapus</a>
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
            <form class="form-horizontal form-label-left" action="{{route('storeSupplier')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nama supplier</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="nama" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Alamat</label>
                    <div class="col-md-9 col-sm-9 ">
                        <textarea name="alamat"  class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Kontak</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="kontak" class="form-control" placeholder="">
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

 {{-- MODAL ADD --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form class="form-horizontal form-label-left" action="{{route('updateSupplier')}}" method="POST">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nama supplier</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="hidden" name="supplier_id" id="edit_supplier_id">
                        <input type="text" name="nama" id="edit_nama" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Alamat</label>
                    <div class="col-md-9 col-sm-9 ">
                        <textarea name="alamat" id="edit_alamat" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Kontak</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="kontak" id="edit_kontak" class="form-control" placeholder="">
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
        $(document).ready(function () {
            $(".btn-edit").click(function (e) {
                e.preventDefault();
                const supplier_id = $(this).data('supplier_id')
                const nama = $(this).data('nama')
                const alamat = $(this).data('alamat')
                const kontak = $(this).data('kontak')

                $("#edit_supplier_id").val(supplier_id)
                $("#edit_nama").val(nama)
                $("#edit_alamat").html(alamat)
                $("#edit_kontak").val(kontak)
            });
        });

        $(".btn-hapus").click(function (e) {
          e.preventDefault();
          const supplier_id = $(this).data('supplier_id')
          swal({
            title: "Yakin?",
            text: "Ingin menghapus item ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "supplier/delete/"+supplier_id
                }
            });
      });
  </script>
@endsection
