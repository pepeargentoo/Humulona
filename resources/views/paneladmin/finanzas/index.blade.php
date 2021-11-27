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
<section class="content-header">
  <div class="row">
    <div class="col-xs-12">
      <div class="box fondo" >
        <div class="box-header">
          <h2 class="box-title" >VENTAS CON IVA</h2>
          <br clear=all>
          <div class="col-md-12" style="background: black;color: white;padding: 16px;font-size: 23px;margin-bottom: 10px;text-align: right;margin-top: 10px;">
            <span style="font-weight:bold;">LIMITE: $</span>{{$limite->limite}}<br>
            <span style="font-weight:bold;">FACTURADO: $</span> <span style="color:red;">{{$limite->actual}}<span>
          </div>

        </div>
        <div class="box-body">
          <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Fecha</th>
              <th style="width:10%">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($facturas as $f)
            <tr>
              <td>
              <span style="font-weight:bold;">FECHA:</span>{{$f->created_at->format('d/m/Y')}}<br>
              <span style="font-weight:bold;">MONTO:$ </span>{{$f->monto}}
            </td>
            <td>
              <a href="{{url('panel/finanzas/facturacion',[$f->id])}}">
                <i class="fa fa-money" style="background: green;color: white;font-size: 27px;border-radius: 3px;"></i>
              </a>
            </td>
            </tr>
            @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection
