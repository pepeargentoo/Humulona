@extends('layouts.admin')
@section('content')
<section class="content" style="">
<br clear=all>
<div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">GRAFICOS</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-pie-chart" style="color:white;"></i>
        </div>
        <a href="{{url('panel/finanzas/graficos')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
     <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">LIMITES</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-money" style="color:white;"></i>
        </div>
        <a href="{{url('panel/finanzas/limites')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">FACTURAR</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-line-chart" style="color:white;"></i>
        </div>
        <a href="{{url('panel/finanzas/facturacion')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

</div>
</section>
@endsection
