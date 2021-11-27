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
          <div class="col-md-6">
            <label>GANACIAS/COSTOS</label>
            <div id="pie-chart" ></div>
          </div>
          <div class="col-md-6">
            <label>GANACIAS/COSTOS/GASTOS</label>
            <div id="pie-chart2" ></div>
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

  Morris.Donut({
  element: 'pie-chart2',
  data: [
    {label: "Ganacias", value: {{$ganancias}} },
    {label: "Gastos", value: {{$gastos}} },
    {label: "Compras", value: {{$compras}} },
    ]
  });
var data = [
      { y: '2014', a: 50, b: 90},
      { y: '2015', a: 65,  b: 75},
      { y: '2016', a: 50,  b: 50},
      { y: '2017', a: 75,  b: 60},
      { y: '2018', a: 80,  b: 65},
      { y: '2019', a: 90,  b: 70},
      { y: '2020', a: 100, b: 75},
      { y: '2021', a: 115, b: 75},
      { y: '2022', a: 120, b: 85},
      { y: '2023', a: 145, b: 85},
      { y: '2024', a: 160, b: 95}
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Total Income', 'Total Outcome'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };
config.element = 'area-chart';
Morris.Area(config);

</script>
@endsection
