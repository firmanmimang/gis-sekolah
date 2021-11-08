@extends('layouts.backend')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title pt-1">Data {{$title}}</h5>

        <div class="card-tools">
          <a href="/sekolah/add" class="btn btn-primary btn-tool">add</a>
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        @if (session('pesan'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-check"></i> {{session('pesan')}}
            </div>
        @endif
        <table id="example1" class="table table-bordered table-striped text-sm">
            <thead>
                <tr>
                    <th class="text-center" width="50px">No.</th>
                    <th>Sekolah</th>
                    <th width="50px">Jenjang</th>
                    <th width="50px">Status</th>
                    <th width="100px">Kecamatan</th>
                    <th class="text-center" width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($sekolah as $data)
                    <tr>
                        <td class="text-center">{{$no++}}</td>
                        <td>{{$data->sekolah}}</td>
                        <td>{{$data->jenjang}}</td>
                        <td>{{$data->status}}</td>
                        <td>{{$data->kecamatan}}</td>
                        <td class="text-center">
                            <a href="/sekolah/edit/{{$data->slug}}" class="btn btn-sm btn-warning"><i class="fas fa-pen-square"></i></a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->slug}}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      <!-- ./card-body -->
      
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

  @foreach ($sekolah as $data)
  <div class="modal fade" id="delete{{$data->slug}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete sekolah</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin delete sekolah {{$data->sekolah}}?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/sekolah/delete/{{$data->slug}}" class="btn btn-outline-light" onclick="event.preventDefault(); document.getElementById('deletesekolah-form{{$data->slug}}').submit();">Ya</a>
          <form id="deletesekolah-form{{$data->slug}}" action="/sekolah/delete/{{$data->slug}}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->  
  @endforeach

<!-- page script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endsection