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
          <h2 class="box-title" >Listado de productos</h2>
          <a  class=" btn btn-primary btncumtome" href="{{url('panel/productos/categorias')}}">
            <i class="fa fa-plus"></i>Categoria
          </a>
          <a class="btn btn-primary btncumtome" href="{{url('panel/productos/crear')}}">
            <i class="fa fa-plus"></i>Producto
          </a>
        </div>
        <div class="box-body">
          <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Datos del Productos</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($productos as $c)

            <tr>
            <td  style="width:80%;">
              <p style="margin: 0px;"><span style="font-weight: bold;">Nombre: </span>{{$c->nombre}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Categoria: </span>{{$c->categoria}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Proveedor: </span>{{$c->proveedor}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">stock: </span>{{$c->unidadactuales}} {{$c->tipo}}</p>
          </td>
            <td>
              <a href="{{url('panel/productos',[$c->id])}}">
                <i class="fa fa-pencil" style="background: #2a2ce1;color: white;font-size: 27px;border-radius: 3px;"></i>
              </a>
              <a href="#" class="borrarcliente" data-id="{{$c->id}}">
                <i class="fa fa-trash" style="background: #ec0d34;color: white;font-size: 27px;border-radius: 3px;"></i>
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

$('.borrarcliente').click(function(e){
  e.preventDefault()
  id= $(this).data('id');
  borrar = $(this).parent().parent()
  url = "{{url('panel/productos/delete')}}"+'/'+id
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Borrar Producto',
    text: "Esta seguro que desea borrar este producto",
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
        'No has borrado, el producto',
        'error'
      )
    }
  })
})

</script>
@endsection
