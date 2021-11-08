@extends('layouts.backend')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title pt-1">Add Data</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form role="form" action="/sekolah/insert" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Sekolah</label>
                      <input type="text" name="sekolah" class="form-control @error('sekolah') is-invalid @enderror" placeholder="Sekolah..." value="{{old('sekolah')}}">
                      <div class="text-danger pl-2">
                          @error('sekolah')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" class="form-control @error('status') is-invalid @enderror">
                          <option value="">--Pilih Status--</option>
                          <option value="Negeri" {{(old('status')=='Negeri')?'selected': null}}>Negeri</option>
                          <option value="Swasta" {{(old('status')=='Swasta')?'selected': null}}>Swasta</option>
                      </select>
                      <div class="text-danger pl-2">
                          @error('status')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Jenjang</label>
                      <select name="id_jenjang" class="form-control @error('id_jenjang') is-invalid @enderror">
                        <option value="">--Pilih Jenjang--</option>
                        @foreach ($jenjang as $data)
                            <option value="{{$data->id}}" {{(old('id_jenjang')==$data->id)?'selected': null}}>{{$data->jenjang}}</option>
                        @endforeach
                      </select>
                      <div class="text-danger pl-2">
                          @error('id_jenjang')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Kecamatan</label>
                      <select name="id_kecamatan" class="form-control @error('id_kecamatan') is-invalid @enderror">
                          <option value="">--Pilih Kecamatan--</option>
                          @foreach ($kecamatan as $data)
                              <option value="{{$data->id}}" {{(old('id_kecamatan')==$data->id)?'selected': null}}>{{$data->kecamatan}}</option>
                          @endforeach
                      </select>
                      <div class="text-danger pl-2">
                          @error('id_kecamatan')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat..." value="{{old('alamat')}}">
                      <div class="text-danger pl-2">
                          @error('alamat')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Deskripsi...">{{old('deskripsi')}}</textarea>
                        <div class="text-danger pl-2">
                            @error('deskripsi')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                     <label for="exampleInputFile">Foto</label>
                     <div class="input-group">
                       <div class="custom-file">
                         <input type="file" name="foto" id="preview_gambar" class="custom-file-input @error('foto') is-invalid @enderror" id="customFile" accept=".png, .jpg, .jpeg">
                         <label class="custom-file-label" for="customFile">Pilih foto max 1mb... (jpg,png,jpeg)(required)</label>
                       </div>
                     </div>
                     <div class="text-danger pl-2">
                      @error('foto')
                          {{$message}}
                      @enderror
                     </div>
                  </div>
                </div>
             
                <div class="col-sm-6">	
                   <div class="form-group">
                       <img src="/img/no_image.jpg" id="image_load" width="200px" class="img-fluid rounded mx-auto d-block mt-2 mb-0">
                   </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Posisi</label>
                      <input type="text" id="posisi" name="posisi" class="form-control @error('posisi') is-invalid @enderror" placeholder="Posisi..." value="{{old('posisi')}}">
                      <div class="text-danger pl-2">
                          @error('posisi')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Map <span class="text-muted">(Drag & drop atau click map)</span></label>
                        <div id="map" style="width: 100%; height: 60vh;"></div>
                    </div>
                </div>
                
            </div>
            <a href="/sekolah" class="btn btn-default btn-sm">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </form>
      </div>
      <!-- ./card-body -->
      
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

<!-- bs-custom-file-input -->
<script src="/adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
</script>
<script>
    function bacaGambar(input){
      if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e){
          $('#image_load').attr('src', e.target.result);
  
        }
  
        reader.readAsDataURL(input.files[0]);
      }
    }
  
    $('#preview_gambar').change(function(){
      bacaGambar(this);
    });
</script>

<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/satellite-v9'
        });


    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/dark-v10'
        });

    var oldposisi = $('#posisi').val();

    var map = L.map('map', {
        center: (oldposisi!='')?[{{old('posisi')}}]:[-7.388182003730649, 109.35498419013591],
        zoom: 13,
        layers: [peta3]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4
    };

    L.control.layers(baseMaps).addTo(map);

    // ambil titik coordinat
    var curLocation = (oldposisi!='')?[{{old('posisi')}}]:[-7.388182003730649, 109.35498419013591];
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: 'true',
    });

    map.addLayer(marker);

    // ambil coord saat marker drag&drop
    marker.on('dragend', function(event){
        var position = marker.getLatLng();
        marker.setLatLng(position,{
            draggable: 'true'
        }).bindPopup(position).update();
        $("#posisi").val(position.lat+","+position.lng).keyup();
    });

    // ambil coord saat marker click
    var posisi = document.querySelector("[name=posisi]");
    map.on("click", function(event){
        var lat = event.latlng.lat;
        var lng = event.latlng.lng;

        if(!marker){
            marker = L.marker(event.latlng).addTo(map)
        }else{
            marker.setLatLng(event.latlng);
        }

        posisi.value = lat+","+lng;
    });
</script>
@endsection
