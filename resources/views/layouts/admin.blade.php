<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{url('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{url('bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{url('dist/css/skins/_all-skins.css')}}">
  <link rel="stylesheet" href="{{url('bower_components/morris.js/morris.css')}}">
  <link rel="stylesheet" href="{{url('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <link rel="stylesheet" href="{{url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{url('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <aside class="main-sidebar" style="background:black;">
    <section class="sidebar">
      <div class="user-panel">
        <center>
        <img src="{{url('logob.png')}}" style="margin:0px;width:80%; float:left;"/>
      </center>
      </div>
      <ul class="sidebar-menu" data-widget="tree" style="font-weight: bold; color: white !important;text-transform: uppercase;font-size: 15px;">
        <li><a href="{{url('panel')}}"><i class="fa fa-briefcase"></i><span>General</span></a></li>
        <li><a href="{{url('panel/gestion')}}"><i class="fa fa-sliders"></i><span>Gestión</span></a></li>
        <li><a href="{{url('panel/estadomesas')}}"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Mesas</span></a></li>
        <li><a href="{{url('panel/stocks')}}"><i class="fa fa-database" aria-hidden="true"></i><span>Stock</span></a></li>
        <li><a href="{{url('panel/finanzas')}}"><i class="fa fa-line-chart"></i><span>Finanzas</span></a></li>
        <li><a href="{{url('panel/salir')}}"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Salir</span></a></li>
        </ul>
    </section>
  </aside>
  <script src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{url('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


  <script src="{{url('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{url('bower_components/morris.js/morris.min.js')}}"></script>
  <div class="content-wrapper" style="background: url('{{url("bgpanel.jpg")}}');">
      @yield('content')
  </div>
</div>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="{{url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<script src="{{url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{url('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{url('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{url('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{url('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{url('dist/js/adminlte.min.js')}}"></script>
<script src="{{url('dist/js/pages/dashboard.js')}}"></script>
<script src="{{url('dist/js/demo.js')}}"></script>
</body>
</html>
