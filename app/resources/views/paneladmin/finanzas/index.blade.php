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

          <a class="btn btn-primary btncumtome" href="{{url('panel/finanzas/facturacion/facturar')}}">
            <i class="fa fa-plus"></i>FACTURAR
          </a>
        </div>
        <div class="box-body">
          <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Datos</th>
            </tr>
          </thead>
          <tbody>
            @foreach($facturas as $f)
            <tr>
              <span>FECHA:</span>{{$f->create_at->format('d/m/Y')}}
              <span>MONTO:</span>{{$f->monto}}
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
