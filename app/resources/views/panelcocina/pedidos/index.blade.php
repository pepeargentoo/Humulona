@extends('layouts.cocina')
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
        <div class="row">
          <h2 class="box-title" style="text-align: center;font-weight: bold;color: white;text-transform: uppercase;" >Pedidos</h2>
        </div>
        <br clear=all>
        @foreach($pedidos as $m)
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue" style="background: #59374d !important;border: 1px solid;border-radius: 10px;">
      
            <div class="inner">
              <h3>{{$m->mesa}}</h3>
              <p style="font-size: 17px;font-weight: bold;text-transform: uppercase;">
                @foreach($m['productos']['producto'] as $k=>$p)
                {{$m['productos']['cantidad'][$k]}} {{$p}}<br>
                @endforeach
              </p>
              <br clear=all>
              <br clear=all>
            </div>
              <a href="{{url('panelcocina/pedidos',[$m->id])}}" class="small-box-footer">FINALIZAR <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endforeach
    </div>
  </div>
</section>
@endsection
