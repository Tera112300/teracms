<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
<title>{{$title}} | TeraCms | Dashboard</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  
  <meta name="robots" content="noindex">{{-- 管理画面はindexさせない --}}
  <link rel="shortcut icon" href="{{asset('images/admin/favicon.ico')}}">
<link rel="apple-touch-icon" href="{{asset('images/admin/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" href="{{asset('images/admin/android.png')}}">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('css/admin_common.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('inner_css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  @include('layouts.admin_common.admin_header')
  @include('layouts.admin_common.admin_sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
  
  @yield('content')
  </div>
  @include('layouts.admin_common.admin_footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.js')}}"></script>
<script src="{{asset('js/util.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.4/ofi.min.js"></script>
<script>
  objectFitImages();
</script>
@yield('inner_js')
</body>
</html>