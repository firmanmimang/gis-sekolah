@extends('layouts.auth')
@section('content')
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>Login Admin</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan login</p>
  
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <div class="invalid-feedback text-danger pl-1">
              @error('email')
                  {{$message}}
              @enderror
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <div class="invalid-feedback text-danger pl-1">
              @error('password')
                  {{$message}}
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                  Ingat Saya
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">
                  {{ __('Login') }}
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <p class="mb-1">
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
              {{ __('Lupa password anda?') }}
            </a>
          @endif
        </p>
        <p class="mb-0">
          @if (Route::has('register'))
            <a href="{{ route('register') }}">{{ __('Daftar user baru') }}</a>
          @endif
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
      
@endsection