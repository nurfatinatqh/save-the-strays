<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>STS | Save The Strays</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-3" style="margin: auto">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa-smile-beam"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Happy Pets</span>
                          <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="far fa-sad-tear"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Homeless Pets</span>
                          <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div><!-- /.col -->
                <div class="col-sm-8">
                    <img src="{{asset('dist\img\4.png')}}" alt="" width="100%" style="padding-right: 3%; padding-left:3% ">
                </div><!-- /.col -->
                <div class="col-sm-1">
                </div><!-- /.col -->
            </div><!-- /.row -->
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        @include('components.top-navigation-bar')
        <br>
        <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">ABOUT US</h3>
                        </div>
                        <div class="card-body">
                        Start creating your amazing application!
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                    </div>
                </div>
                </div>
            </section>
            <!-- /.content -->
    </div>
    <!-- /.content-header -->
    </div>
    <!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
