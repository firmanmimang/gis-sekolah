@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3">
          <a href="/kecamatan" style="color:#000;">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-layer-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kecamatan</span>
              <span class="info-box-number">{{count($kecamatan)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-lg-3">
          <a href="/jenjang" style="color:#000;">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jenjang</span>
              <span class="info-box-number">{{count($jenjang)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-lg-3">
          <a href="/sekolah" style="color:#000;">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-school"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sekolah</span>
              <span class="info-box-number">{{count($sekolah)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-lg-3">
          <a href="/user" style="color:#000;">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">User</span>
              <span class="info-box-number">{{count($user)}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</div>
@endsection
