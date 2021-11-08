@extends('layouts.frontend')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Pemetaan Sekolah</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div id="map" style="width: 100%; height: 80vh;"></div>
      </div>
      <!-- ./card-body -->
      
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->


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
    
    @foreach($kecamatan as $data)
        var data{{$data->slug}} = L.layerGroup();
    @endforeach

    var sekolah = L.layerGroup();

    var map = L.map('map', {
        center: [-7.388182003730649, 109.35498419013591],
        zoom: 13,
        layers: [peta3, 
        @foreach($kecamatan as $data)
        data{{$data->slug}},
        @endforeach
        sekolah
        ]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4
    };

    var overLayer = {
        @foreach($kecamatan as $data)
            "{{$data->kecamatan}}": data{{$data->slug}},
        @endforeach
        "Sekolah": sekolah
    };

    L.control.layers(baseMaps, overLayer).addTo(map);

    @foreach($kecamatan as $data)
        L.geoJSON({!!$data->geojson!!}, {
            style: {
                color: 'black',
                fillColor: '{{$data->warna}}',
                fillOpacity: 0.5
            },
        }).addTo(data{{$data->slug}});
    @endforeach

    @foreach($sekolah as $data)
      var iconsekolah = L.icon({
          iconUrl: '{{asset('img/icon')}}/{{$data->icon}}',
          iconSize: [38, 38],
      });

      var informasi = `
      <table class="table table-bordered">
      <thead>
        <tr>
          <td colspan="2"><img src="/img/sekolah/{{$data->foto}}" alt="{{$data->foto}}" width="200" class="rounded"></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Nama Sekolah</td>
          <td>{{$data->sekolah}}</td>
        </tr>
        <tr>
          <td>Jenjang</td>
          <td>{{$data->jenjang}}</td>
        </tr>
        <tr>
          <td>Status</td>
          <td>{{$data->status}}</td>
        </tr>
        <tr>
          <td colspan="2" class="text-center"><a href="/detailsekolah/{{$data->slug}}" class="btn btn-success btn-sm" style="color:#fff;">Detail</a></td>
        </tr>
      </tbody>
      </table>`;

      L.marker([{!!$data->posisi!!}], {icon: iconsekolah})
      .addTo(sekolah)
      .bindPopup(informasi);
    @endforeach
</script>
@endsection
