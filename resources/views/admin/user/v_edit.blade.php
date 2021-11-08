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
        <form role="form" action="/user/update/{{$user->username}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name..." value="{{$user->name}}">
                      <div class="text-danger pl-2">
                          @error('name')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username..." value="{{$user->username}}" readonly>
                      <div class="text-danger pl-2">
                          @error('username')
                              {{$message}}
                          @enderror
                      </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email..." value="{{$user->email}}" readonly>
                      <div class="text-danger pl-2">
                          @error('email')
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
                         <label class="custom-file-label" for="customFile">{{($user->foto)? $user->foto : 'Pilih foto max 1mb... (not required)'}}</label>
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
                       <img src="{{ ($user->foto)? '/img/user/'.$user->foto : '/img/nouser.png' }}" id="image_load" width="200px" class="rounded mx-auto d-block my-1">
                   </div>
                 </div>
                
            </div>
            <a href="/user" class="btn btn-default btn-sm">Kembali</a>
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
