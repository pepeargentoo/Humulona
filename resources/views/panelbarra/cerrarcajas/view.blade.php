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
  .btncumtome{
    float: right;color: white;
    background: #294837;
    font-weight: bold;
    border: 1px solid;
    font-size: 15px;
    text-align: center;
    text-transform: uppercase;
  }
  table thead{
    background:black;color:white;text-transform:uppercase;
  }


</style>

<section class="content-header " >
  <div class="row">
    <div class="col-xs-12">
      <div class="row">
       
      <br clear=all>
      <div class="box-body fondo">
         <h2 class="box-title" style="text-align: center;font-weight: bold;color: white;text-transform: uppercase;" >FECHA {{$cierre->fecha}}</h2>
        
          <br clear="all">
          <br clear="all">
          <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Mesa</th>
              <th>Precio</th>
            </tr>
          </thead>
          <tbody>
            @foreach($productos as $c)
            <tr>
            <td  style="">
              <p style="margin: 0px;    margin: 0px;
    font-weight: bold;
    color: white;
    font-size: 18px;">{{$c->mesa}}</p>
            </td>
            <td>
              <p style="margin: 0px;    margin: 0px;
    font-weight: bold;
    color: white;
    font-size: 18px;">$ {{$c->precio}}</p>
            </td>
            </tr>
            @endforeach
          </tbody>
          </table>
          <br clear="all">
          <h2 class="box-title" style="text-align: right;font-weight: bold;color: white;text-transform: uppercase;" >TOTAL: ${{$cierre->monto}}</h2>
    </div>
  </div>
</section>
@endsection
