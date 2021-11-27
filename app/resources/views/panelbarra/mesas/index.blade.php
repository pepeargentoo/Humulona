@extends('layouts.barra')
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

<section class="content-header" >

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
          @if($m->ocupada == "no")
           style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
           @else
           @if($m->estadia[0]->estado == "esperando")
           style="background: red !important;border: 1px solid;border-radius: 10px;">
           @else
           style="background: #59374d !important;border: 1px solid;border-radius: 10px;">
           @endif
           @endif

            <div class="inner">
              <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">{{$m->nombre}}</p>
              <br clear=all>
              <br clear=all>
            </div>
            <div class="icon">
              <i class="fa fa-calendar" aria-hidden="true" style="color:white;"></i>
            </div>
            @if($m->ocupada == "si")
              <a href="{{url('panelbarra/mesa/ver',[$m->id])}}" class="small-box-footer">VER <i class="fa fa-arrow-circle-right"></i></a>
              
              @if($m->estadia[0]->comida == 1)
                <a href="{{url('panelbarra/cocina',[$m->estadia[0]->id])}}" class="small-box-footer">TIKET COCINA<i class="fa fa-arrow-circle-right"></i></a>
              @endif
              @if($m->estadia[0]->bebida == 1)
                <a href="{{url('panelbarra/bebida',[$m->estadia[0]->id])}}" class="small-box-footer">TIKET BARRA<i class="fa fa-arrow-circle-right"></i></a>
              @endif
              <a href="{{url('panelbarra/cerrarmesa',[$m->id])}}" class="small-box-footer">CERRAR MESA<i class="fa fa-arrow-circle-right"></i></a>
              <a href="{{url('panelbarra/cerrarmesaiva',[$m->id])}}" class="small-box-footer">FACTURAR<i class="fa fa-arrow-circle-right"></i></a>

              
            @else
              <a href="{{url('panelbarra')}}" class="small-box-footer">ATRAS<i class="fa fa-arrow-circle-right"></i></a>
            @endif
            </div>
        </div>
        @endforeach
    </div>
  </div>
</section>

<script>
  

</script>
@endsection
