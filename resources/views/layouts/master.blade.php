<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>MCstock</title>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/app-custom.css">
    
    
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper ">

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-custom ">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/js/app.js"></script>
<script src="{!! asset('vendor/jquery.number.min.js') !!}"></script>
<script src="{!! asset('js/jquery.setformat.js') !!}"></script>
@yield('scripts')
</body>
</html>
