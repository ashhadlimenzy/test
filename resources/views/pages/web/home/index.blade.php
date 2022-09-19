@extends('layouts.web')
@section('content')
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-lightblue navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <div class="h-10 d-flex align-items-center justify-content-center">
          <div class="login-logo">
          <a href = "{{url('/')}}" class = "brand-link">
            <img src = "{{url('images/HOSAPP.png')}}" alt = "CAPP Logo" class = "brand-image img-circle elevation-3" style = "opacity: .8" width="1000px">
            <b style="color:white;">Hello &nbsp;&nbsp;</b>DOC
          </a>  
          </div>
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
    
    @if (Auth::guard('user')->check())
        <a href="{{ route('user.home') }}" class="btn btn-success">Dashboard</a>
    @else
        <a href="{{ route('user.login') }}" class="btn btn-danger">Log in</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        @if (Route::has('user.register'))
            <a href="{{ route('user.register') }}" class="btn btn-success">Register</a>&nbsp;&nbsp;&nbsp;&nbsp;
        @endif
    @endauth
         
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <center><img src = "{{url('images/HOSAPP.png')}}" alt = "CAPP Logo" class = "brand-image img-circle elevation-3" style = "opacity: .8" width="110px"></center>
    <div class="login-logo">
      <a href="#"><b>Hello &nbsp;&nbsp;</b>DOC</a>
    </div>
    <div class="row mt-4">
    <div class="row mt-4">
    
                  <div class="col-sm-4">
                    <div class="position-relative">
                      <img src="{{url('images/cardiology2.png')}}" alt="CARDIOLOGY" class="img-fluid">
                      <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-success text-lg">
                          CARDIOLOGY
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative">
                      <img src="{{url('images/images1.jpeg')}}" alt="PEDIATRICS" class="img-fluid" width="500px" height="10px">
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-warning text-lg">
                          PEDIATRICS
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="position-relative" style="min-height: 100px;">
                      <img src="{{url('images/neurology.jpg')}}" alt="NEUROLOGY" class="img-fluid" width="500px" >
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-danger text-xl">
                          NEUROLOGY
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    <div class="row mt-4">
    <div class="row mt-4">          
                <img src="{{url('images/Good-Hospital_blog.png')}}" alt="Photo 1" class="img-fluid" width="1320px">
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="#">Hello DOC</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../jqvmap/jquery.vmap.min.js"></script>
<script src="../jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../moment/moment.min.js"></script>
<script src="../daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../js/pages/dashboard.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
    <!-- </div> -->
@endsection
