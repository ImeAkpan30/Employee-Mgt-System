@extends('layouts.app-template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-top: 4rem;">
      <h1 class="text-danger">
        State Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> System Management</a></li>
        <li class="active">State</li>
      </ol>
    </section>
    @yield('action-content')

    <!-- /.content -->
  </div>
@endsection
