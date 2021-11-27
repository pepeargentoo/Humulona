@extends('layouts.mozos')
@section('content')
<style>
.fondo{
  background: #407759;border-radius: 10px;border: 2px solid white;
}
.fondohear{
  text-align:center;
}
.fondohear i{
  font-size: 63px !important;color: white;
}
.fondohear h2{
  font-weight: bold;color: white;
  font-size: 25px !important;
}
label{
  color:white;
  text-transform:uppercase;
  font-size:18px;
}
.btnctm{
  float: right;color: white;background: #294837;font-weight: bold;border: 1px solid;font-size: 15px;
}
</style>
<section class="content-header">
  <div class="col-xs-12">
    <div class="box fondo" >
      <div class="box-header fondohear" >
        <i class="fa fa-cutlery" aria-hidden="true" ></i>
        <br clear=all>
        <h2 class="box-title" >{{$estadiaedit->mesa}}</h2>
      </div>
      <div class="box-body">
        <label>Lista de Consumo</label>
        <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <th style="width:10%;">Cantidad</th>
            <th>Articulo</th>
            <th style="width:10%;">Precio</th>
          </thead>
          <tbody>
            @foreach($estadiaedit['productos'] as $p)
            <tr>
              <td style="width:10%;">{{$p->cantida}}</td>
              <td>{{$p->nombre}}</td>
              <td style="width:10%;">${{$p->monto}}</th>
            </tr>
            @endforeach
          </tbody>
        </table>
        <h3>Total $ <span id="total">{{$estadiaedit->monto}}</span></h3>
        <br clear=all>
        @if(isset($cerrar))
        <a class=" btn btn-primary btnctm"  href="{{url('panelmozo/mesas/cerrar/aprobacion',[$estadiaedit->id])}}">CERRAR</a>
        @endif
        <a class=" btn btn-primary btnctm"  href="{{url('panelmozo/mesas')}}">ATRAS</a>
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
