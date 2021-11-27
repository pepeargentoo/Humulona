@extends('layouts.admin')
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
          <h2 class="box-title" style="text-align: center;
font-weight: bold;
color: white;
text-transform: uppercase;" >Mesas</h2>
        </div>
        <br clear=all>
        @foreach($mesas as $m)
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-blue" style="background: #42795b !important;border: 1px solid;border-radius: 10px;">
            <div class="inner">
              <p style="font-size: 20px;font-weight: bold;text-transform: uppercase;">{{$m->nombre}}</p>
              <br clear=all>
              <br clear=all>
            </div>
            <div class="icon">
              <i class="fa fa-calendar" aria-hidden="true" style="color:white;"></i>
            </div>
            <a href="{{url('panel/mozos')}}" class="small-box-footer">INFORMACION <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endforeach

    </div>
  </div>
</section>
@endsection
