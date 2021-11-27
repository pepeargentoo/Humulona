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
         <h2 class="box-title" style="text-align: center;font-weight: bold;color: white;text-transform: uppercase;" >HISTORIAL DE CIERRES</h2>
        <a class=" btn btn-primary btncumtome"  href="{{url('panelbarra/cerrarcaja/cerrar')}}">
            <i class="fa fa-plus"></i>CERRAR CAJA
          </a>
          <br clear="all">
          <br clear="all">
          <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Datos Cierre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cierres as $c)
            <tr>
            <td  style="width:90%;">
              <p style="margin: 0px;"><span style="font-weight: bold;">FECHA: </span>{{$c->fecha}}<br>
              <span style="font-weight: bold;">MONTO: $</span>{{$c->monto}}
              </p>
          </td>
            <td>
              <a href="{{url('panelbarra/cerrarcaja/cerrar',[$c->id])}}">
                <i class="fa fa-eye" style="color: blue;font-size: 27px;border-radius: 3px;"></i>
              </a>
            </td>
            </tr>
            @endforeach
          </tbody>
          </table>
    </div>
  </div>
</section>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
  

</script>
@endsection
