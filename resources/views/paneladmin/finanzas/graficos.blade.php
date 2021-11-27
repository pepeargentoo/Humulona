@extends('layouts.admin')
@section('content')
<style>
.fondo{
  background: #407759;
  border-radius: 10px;
  border: 2px solid white;
}
.fondohear{
  text-align:center;
}
.fondohear i{
  font-size: 63px !important;
  color: white;
}
.fondohear h2,.stock{
  font-weight: bold;
  color: white;
  font-size: 25px !important;
}
label{
  color:white;
  text-transform:uppercase;
  font-size:18px;
}

.btnctm{
  float: right;
  color: white;
  background: #294837;
  font-weight: bold;
  border: 1px solid;
  font-size: 15px;
}
</style>
<section class="content-header">
<div class="row">
    <div class="col-xs-12">
     <div class="box fondo" >
      <div class="box-header fondohear" >
        <i class="fa fa-money" aria-hidden="true" ></i>
        <br clear=all>
        <h2 class="box-title" >GRAFICOS</h2>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-10">
            <label>GANACIAS/COSTOS</label>
            <div id="pie-chart"  style="width:100%"></div>
          </div>
          <div class="col-md-2">
            <a href="{{url('panel/finanzas/graficos/gastos')}}" class="btn btn-primary" style=" width: 100%;float: right;color: white;background:black;border: none;font-weight: bold;">Gastos</a>
            <a href="{{url('panel/finanzas/graficos/empleados')}}" class="btn btn-primary" style="width: 100%;float: right;color: white;background:black;border: none;font-weight: bold;">Empleados</a>
            <a href="{{url('panel/finanzas/graficos/cierredecaja')}}" class="btn btn-primary" style="width: 100%;float: right;color: white;background:black;border: none;font-weight: bold;">Cierres de Cajas</a>
          </div>
          <br clear="all">
          <div class="col-md-12">
            <div id="area-chart" ></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<script>
  Morris.Donut({
  element: 'pie-chart',
  data: [
      {label: "Ganacias", value: {{$ganancias}} },
      {label: "Gastos", value: {{$gastos+ $compras}} },
    ]
  });
var data = [
@foreach($cajas as $k => $v)
 { 'fecha':'{{$k}}', 'monto':{{$v}} },
@endforeach
]
config = {
      data: data,
      xkey: ['fecha'],
      ykeys: ['monto'],
      labels: ['Monto', 'fecha'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray']
  };
config.element = 'area-chart';

Morris.Line(config);

</script>
@endsection
