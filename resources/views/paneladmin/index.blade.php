@extends('layouts.admin')
@section('content')
<section class="content" style="">
<br clear=all>
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
      <div class="inner">
        <p style="font-size: 23px;font-weight: bold;text-transform: uppercase;">Gestión</p>
        <br clear=all>
        <br clear=all>
      </div>
      <div class="icon">
        <i class="fa fa-sliders" aria-hidden="true" style="color:white;"></i>
      </div>
      <a href="{{url('panel/gestion')}}" class="small-box-footer" style="background: #294837;border: none;border-radius: 0px 0px 10px 10px;">VER <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
      <div class="inner">
        <p style="font-size: 23px;font-weight: bold;text-transform: uppercase;">Mesas</p>
        <br clear=all>
        <br clear=all>
      </div>
      <div class="icon">
        <i class="fa fa-cutlery" aria-hidden="true" style="color:white;"></i>
      </div>
      <a href="{{url('panel/estadomesas')}}" class="small-box-footer" style="background: #294837;border: none;border-radius: 0px 0px 10px 10px;">VER <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
      <div class="inner">
        <p style="font-size: 23px;font-weight: bold;text-transform: uppercase;">Stock</p>
        <br clear=all>
        <br clear=all>
      </div>
      <div class="icon">
        <i class="fa fa-database" style="color:white;"></i>
      </div>
      <a href="{{url('panel/stocks')}}" class="small-box-footer" style="background: #294837;border: none;border-radius: 0px 0px 10px 10px;">VER <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
      <div class="inner">
        <p style="font-size: 23px;font-weight: bold;text-transform: uppercase;">Fianazas</p>
        <br clear=all>
        <br clear=all>
      </div>
      <div class="icon">
        <i class="fa fa-line-chart" style="color:white;"></i>
      </div>
      <a href="{{url('panel/finanzas')}}" class="small-box-footer" style="background: #294837;border: none;border-radius: 0px 0px 10px 10px;">VER <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  



</div>
</section>
@endsection
