@extends('layouts.admin')
@section('content')
<section class="content" style="">
<br clear=all>
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
      <div class="inner">
        <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Barra</p>
        <br clear=all>
        <br clear=all>
      </div>
      <div class="icon">
        <i class="fa fa-beer" aria-hidden="true" style="color:white;"></i>
      </div>
      <a href="{{url('panel/barra')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Cocina</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa  fa-thermometer-half" aria-hidden="true" style="color:white;"></i>
        </div>
        <a href="{{url('panel/cocina')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Mozos</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-users" aria-hidden="true" style="color:white;"></i>
        </div>
        <a href="{{url('panel/mozos')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Proveedores</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-cubes" aria-hidden="true" style="color:white;"></i>
        </div>
        <a href="{{url('panel/proveedores')}}" class="small-box-footer" >VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Productos</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-glass" aria-hidden="true" style="color:white;"></i>
        </div>
        <a href="{{url('panel/productos')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">PRECIOS</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-btc" style="color:white;"></i>
        </div>
        <a href="{{url('panel/precios')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Mesas</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-calendar" style="color:white;"></i>
        </div>
        <a href="{{url('panel/mesas')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">DISTRIBUCION</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-cutlery" style="color:white;"></i>
        </div>
        <a href="{{url('panel/asignacion')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">COMPRAS</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-bag" style="color:white;"></i>
        </div>
        <a href="{{url('panel/compras')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-maroon" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
        <div class="inner">
          <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">GASTOS</p>
          <br clear=all>
          <br clear=all>
        </div>
        <div class="icon">
          <i class="fa fa-money" style="color:white;"></i>
        </div>
        <a href="{{url('panel/gastos')}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

</div>
</section>
@endsection
