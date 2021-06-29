@extends('layouts.master')
@section('title','Jenis Barang')

@section('page_title','Jenis Barang')
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
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Jenis Barang</a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
            <div class="x_content">
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th width="20%">#</th>
                    <th width="40%">Nama Jenis</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jeniss as $jenis)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$jenis->nama_jenis}}</td>
                            <td>
                                <a href="#" class="btn btn-warning edit-jenis" data-nama_jenis="{{$jenis->nama_jenis}}" data-jenis_id="{{$jenis->id}}" data-toggle="modal" data-target="#editModal">Edit</a>
                                <a href="#" class="btn btn-danger hapus-jenis" data-jenis_id="{{$jenis->id}}">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

            </div>
        </div>
      </div>
</div>
@endsection
@section('linkfooter')

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form class="form-horizontal form-label-left" action="{{route('storeJenis')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nama Jenis Barang</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="nama_jenis" class="form-control" placeholder="Masukkan disini...">
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


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form class="form-horizontal form-label-left" action="{{route('updateJenis')}}" method="POST">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Nama Jenis Barang</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="hidden" name="jenis_id" id="edit_jenis_id" value="">
                        <input type="text" name="nama_jenis" id="edit_nama_jenis" class="form-control" value="">
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

  <script>
      $(".hapus-jenis").click(function (e) {
          e.preventDefault();
          const jenis_id = $(this).data('jenis_id')
          swal({
            title: "Yakin?",
            text: "Ingin menghapus item ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "jenis-barang/delete/"+jenis_id
                }
            });
      });

      $(".edit-jenis").click(function (e) {
          e.preventDefault();
          const jenis_id = $(this).data('jenis_id')
          const nama_jenis = $(this).data('nama_jenis')

          $("#edit_jenis_id").val(jenis_id)
          $("#edit_nama_jenis").val(nama_jenis)
      });
  </script>

@endsection


