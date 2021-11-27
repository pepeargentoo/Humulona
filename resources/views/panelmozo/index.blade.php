@extends('layouts.mozos')
@section('content')
<style>
  .fondo{
    background: #407759;border-radius: 10px;border: 2px solid white;
  }

  .fondo h2 {
    color: white;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
  }

</style>

<section class="content-header">

  <div class="row">
    <div class="col-xs-12">
      @if(Session::has('mensaje'))
        <p style="background: black;padding: 25px;color: white;text-transform: uppercase;">{{ Session::get('mensaje') }}</p>
    @endif
        <div class="row">
          <h2 class="box-title" style="text-align: center;font-weight: bold;color: white;text-transform: uppercase;" >Mesas</h2>
        </div>
        <br clear=all>
        @foreach($mesas as $m)
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue"

          @if($m->estado !== "ocupada")
           style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
           @else
           style="background: #59374d !important;border: 1px solid;border-radius: 10px;">
           @endif
            <div class="inner">
              <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">{{$m->nombre}}</p>
              <br clear=all>
              <br clear=all>
            </div>
            <div class="icon">
              <i class="fa fa-calendar" aria-hidden="true" style="color:white;"></i>
            </div>
            @if($m->estado == "ocupada")
              <a href="{{url('panelmozo/mesa/ver',[$m->id])}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('panelmozo/mozos/mesa/cerrar',[$m->id])}}" class="small-box-footer">CERRAR MESA <i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('panelmozo/mozos/agregar',[$m->id])}}" class="small-box-footer">AGREGAR<i class="fa fa-arrow-circle-right"></i></a>
             
              

            @else
              <a href="{{url('panelmozo/mesas/tomar',[$m->id])}}" class="small-box-footer">TOMAR <i class="fa fa-arrow-circle-right"></i></a>
            @endif
            </div>
        </div>
        @endforeach
    </div>
  </div>
</section>
@endsection
