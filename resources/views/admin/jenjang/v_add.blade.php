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
        <form role="form" action="/jenjang/insert" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Jenjang</label>
                      <input type="text" name="jenjang" class="form-control @error('jenjang') is-invalid @enderror" placeholder="Jenjang..." value="{{old('jenjang')}}">
                      <div class="text-danger pl-2">
                          @error('jenjang')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                     <label for="exampleInputFile">Icon</label>
                     <div class="input-group">
                       <div class="custom-file">
                         <input type="file" name="icon" id="preview_gambar" class="custom-file-input @error('icon') is-invalid @enderror" id="customFile" accept="image/png">
                         <label class="custom-file-label" for="customFile">Pilih gambar png max 1mb... (required)</label>
                       </div>
                     </div>
                     <div class="text-danger pl-2">
                      @error('icon')
                          {{$message}}
                      @enderror
                     </div>
                  </div>
                </div>

                <div class="col-sm-6"></div>
             
                 <div class="col-sm-6">	
                   <div class="form-group">
                       <img src="/img/no_image.jpg" id="image_load" width="200px" class="rounded mx-auto d-block my-1">
                   </div>
                 </div>
                
            </div>
            <a href="/jenjang" class="btn btn-default btn-sm">Kembali</a>
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

@endsection
