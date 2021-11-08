@extends('layouts.frontend')

@section('content')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title pt-1">Pemetaan Sekolah</h5>

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

  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title pt-1">Data Sekolah Kecamatan {{$detailkecamatan->kecamatan}}</h5>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped text-sm">
          <thead>
              <tr>
                  <th class="text-center" width="50px">No.</th>
                  <th>Sekolah</th>
                  <th width="50px">Jenjang</th>
                  <th width="50px">Status</th>
                  <th width="100px">Kecamatan</th>
                  <th width="200px">Posisi</th>
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
                      <td>{{$data->posisi}}</td>
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

    var data{{$detailkecamatan->slug}} = L.layerGroup();

    @foreach($jenjang as $data)
        var jenjang{{$data->slug}} = L.layerGroup();
    @endforeach

    var map = L.map('map', {
        center: [-7.388182003730649, 109.35498419013591],
        zoom: 13,
        layers: [peta3, data{{$detailkecamatan->slug}},
          @foreach($jenjang as $data)
            jenjang{{$data->slug}},
          @endforeach
        ]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4
    };

    var overLayer = {
        "{{$detailkecamatan->kecamatan}}": data{{$detailkecamatan->slug}},
        @foreach($jenjang as $data)
        "{{$data->jenjang}}":  jenjang{{$data->slug}},
        @endforeach
    };

    L.control.layers(baseMaps, overLayer).addTo(map);

    var kec = L.geoJSON({!!$detailkecamatan->geojson!!}, {
        style: {
            color: 'black',
            fillColor: '{{$detailkecamatan->warna}}',
            fillOpacity: 0.5
        },
    }).addTo(data{{$detailkecamatan->slug}});

    map.fitBounds(kec.getBounds());

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
      .addTo(jenjang{{$data->slugjenjang}})
      .bindPopup(informasi);
    @endforeach
</script> 

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