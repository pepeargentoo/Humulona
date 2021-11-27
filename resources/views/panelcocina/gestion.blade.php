@extends('layouts.cocina')
@section('content')
<section class="content" style="">
<br clear=all>
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
      <div class="inner">
        <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Pedidos</p>
        <br clear=all>
        <br clear=all>
      </div>
      <div class="icon">
        <i class="fa fa-bullhorn" style="color:white;"></i>
      </div>
      <a href="{{url('panelcocina/pedidos')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
      <div class="inner">
        <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">SALIR</p>
        <br clear=all>
        <br clear=all>
      </div>
      <div class="icon">
        <i class="fa fa-sign-out" style="color:white;"></i>
      </div>
      <a href="{{url('panelcocina/salir')}}" class="small-box-footer">SALIR <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
</section>
@endsection
