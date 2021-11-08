@extends('layouts.frontend')

@section('content')

<div class="col-md-6">
    <div id="map" style="width: 100%; height: 60vh;"></div>
    <br>
</div>

<div class="col-md-6">
    <img src="/img/sekolah/{{$sekolah->foto}}" class="img-fluid rounded" alt="{{$sekolah->foto}}" width="100%">
    <br><br>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <h5 class="card-title pt-1">Detail Sekolah Kecamatan {{$sekolah->sekolah}}</h5>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped text-sm">
            <tr>
                <td>Nama Sekolah</td>
                <td>{{$sekolah->sekolah}}</td>
            </tr>
            <tr>
                <td>Jenjang</td>
                <td>{{$sekolah->jenjang}}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{$sekolah->status}}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>{{$sekolah->kecamatan}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{$sekolah->alamat}}</td>
            </tr>
          </table>
        </div>
        <!-- ./card-body -->
        
    </div>
    <!-- /.card -->
</div>
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

    var map = L.map('map', {
        center: [{!!$sekolah->posisi!!}],
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

    var iconsekolah = L.icon({
          iconUrl: '{{asset('img/icon')}}/{{$sekolah->icon}}',
          iconSize: [38, 38],
      });

      L.marker([{!!$sekolah->posisi!!}], {icon: iconsekolah})
      .addTo(map)
</script>
@endsection