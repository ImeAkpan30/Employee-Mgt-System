<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EM | Employee Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->

   <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
   <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  @include('layouts.header')
  <!-- Sidebar -->
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-top: 4rem;">
      <h1 class="text-danger">
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li-->
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <div class="container-fluid" style="margin-top: 15px">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6 wow zoomIn" data-wow-duration="3s">
            <!-- small box -->
            <div class="small-box bg-info" style="background-color: #17a2b8">
              <div class="inner">

              <h3>{{$employees->count()}}</h3>
                {{-- <h3>10</h3> --}}


                <p>Employees</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              @if(Auth::user()->role=='admin')
              <a href="{{ url('employee-management') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              @endif
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 wow zoomIn" data-wow-duration="3s">
            <!-- small box -->
            <div class="small-box bg-success" style="background-color: #28a745">
              <div class="inner">
                <h3>{{ $companies->count() }}</h3>

                <p>Companies</p>
              </div>
              <div class="icon">
                <i class="fa fa-institution"></i>
              </div>
              @if(Auth::user()->role=='admin')
              <a href="{{ url('company-management') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              @endif
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 wow zoomIn" data-wow-duration="3s">
            <!-- small box -->
            <div class="small-box bg-warning" style="background-color: #ffc107">
              <div class="inner">
                {{-- <h3>3</h3> --}}

                <h3>{{ $leaves->count() }}</h3>


                <p>Leaves</p>
              </div>
              <div class="icon">
                <i class="fa fa-folder-open"></i>
              </div>
              @if(Auth::user()->role=='admin')
              <a href="{{ url('/leave') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              @endif
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 wow zoomIn" data-wow-duration="3s">
            <!-- small box -->
            <div class="small-box bg-danger" style="background-color: #dc3545">
              <div class="inner">
                <h3>{{ $users->count() }}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              @if(Auth::user()->role=='admin')
              <a href="{{ url('user-management') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              @endif
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>


    <!-- Main content -->
    <section class="content">
        @include('sweetalert::alert')
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  @include('layouts.footer')

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

 <!-- jQuery 2.1.3 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

<script src="{{ asset('js/wow.min.js') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
     <script>
        new WOW().init();
    </script>

    <!-- Begin of Chaport Live Chat code -->
<script type="text/javascript">
    (function(w,d,v3){
    w.chaportConfig = {
    appId : '600944aa27f3994c3b9b9aa7'
    };

    if(w.chaport)return;v3=w.chaport={};v3._q=[];v3._l={};v3.q=function(){v3._q.push(arguments)};v3.on=function(e,fn){if(!v3._l[e])v3._l[e]=[];v3._l[e].push(fn)};var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://app.chaport.com/javascripts/insert.js';var ss=d.getElementsByTagName('script')[0];ss.parentNode.insertBefore(s,ss)})(window, document);
    </script>
    <!-- End of Chaport Live Chat code -->
</body>
</html>
