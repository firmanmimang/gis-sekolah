@extends('layouts.backend')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title pt-1">Edit Data</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form role="form" action="/kecamatan/update/{{$kecamatan->slug}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Kecamatan</label>
                      <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Kecamatan..." value="{{$kecamatan->kecamatan}}">
                      <div class="text-danger pl-2">
                          @error('kecamatan')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Warna</label>
      
                        <div class="input-group my-colorpicker2">
                          <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror" placeholder="Warna..." value="{{$kecamatan->warna}}">
      
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                          </div>
                        </div>
                        <div class="text-danger pl-2">
                            @error('warna')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>geoJSON</label>
                        <textarea name="geojson" rows="5" class="form-control @error('geojson') is-invalid @enderror" placeholder="geoJSON...">{{$kecamatan->geojson}}</textarea>
                        <div class="text-danger pl-2">
                            @error('geojson')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <a href="/kecamatan" class="btn btn-default btn-sm">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </form>
      </div>
      <!-- ./card-body -->
      
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

<!-- bootstrap color picker -->
<script src="/adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script>
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
</script>
@endsection
