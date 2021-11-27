@extends('layouts.admin')
@section('content')
<section class="content-header">
  <div class="row">
    <div class="col-xs-12">
      <div class="box" style="background: #fcf4f480;border-radius: 13px;">
        <div class="box-header">
          <h2 class="box-title" style="color:black;">Listado de Clientes</h2>
          <a style="float: right;color: white;font-size: 15px;background: black;padding: 8px;margin-top: 0px;margin-bottom: 0px;font-weight: bold;" href="{{url('panel/clientes/crear')}}">
            <i class="fa fa-plus"></i>Cliente
          </a>
        </div>
        <div class="box-body">
          <table id="myTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Datos del Clientes</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($clientes as $c)
            <tr>
            <td  style="width:80%;">
              <p style="margin: 0px;"><span style="font-weight: bold;">Nombre: </span>{{$c->nombre}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Email: </span>{{$c->email}}</p>
          </td>
            <td>
              <a href="{{url('panel/clientes/edit',[$c->id])}}">
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
