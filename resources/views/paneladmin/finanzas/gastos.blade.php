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
          <h2 class="box-title" >Listado de gastos</h2>
        </div>
        <div class="box-body">
          <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>DAtos</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach($gastos as $c)
            <tr>
            <td  style="width:90%;">
              <p style="margin: 0px;"><span style="font-weight: bold;">Descripcion: </span>{{$c->descripcion}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Monto:$ </span>{{$c->monto}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Fecha: </span>{{$c->created_at->format('d/m/Y') }}</p>
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

$('.borrarcliente').click(function(e){
  e.preventDefault()
  id= $(this).data('id');
  borrar = $(this).parent().parent()
  url = "{{url('panel/clientes/delete/')}}"+'/'+id
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Borrar Cliente',
    text: "Esta seguro que desea borrar este cliente",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, confirmar',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      $.get(url,function(res){
        if(res.success == "true"){
          swalWithBootstrapButtons.fire(
            'Borrado!',
            'Fue borrado correctamente.',
            'success'
          )
        }
        borrar.remove()
      })
    } else if (
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Cancelado',
        'No has borrado, el cliente',
        'error'
      )
    }
  })
})

</script>
@endsection
