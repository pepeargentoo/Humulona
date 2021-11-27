@extends('layouts.admin')
@section('content')
<section class="content-header">
  <div class="row">
    <div class="col-xs-12">
      <div class="box" style="background: #407759;border-radius: 10px;border: 2px solid white;">
        <div class="box-header">
          <h2 class="box-title" style="color: white;font-size: 18px;font-weight: bold;text-transform: uppercase;">Listado de Mozos</h2>
          <a  class="btn btn-primary" style="float: right;color: white;background: #294837;font-weight: bold;border: 1px solid;font-size: 15px;text-align: center;text-transform: uppercase;" href="{{url('panel/mozos/crear')}}">
            <i class="fa fa-plus"></i>Mozos
          </a>
        </div>
        <div class="box-body">
          <table id="myTable" class="table table-bordered table-hover">
          <thead style="background:black;color:white;text-transform:uppercase;">
            <tr>
              <th >Datos del Mozo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mozos as $c)
            <tr>
            <td  style="width:80%;">
              <p style="margin: 0px;"><span style="font-weight: bold;">Nombre: </span>{{$c->nombre}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Telefono: </span>{{$c->telefono}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Email: </span>{{$c->email}}</p>
              <p style="margin: 0px;"><span style="font-weight: bold;">Direccion: </span>{{$c->direccion}}</p>
          </td>
            <td>
              <a href="{{url('panel/mozos/edit',[$c->id])}}">
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
  url = "{{url('panel/mozos/delete')}}"+'/'+id
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Borrar Mozo',
    text: "Esta seguro que desea borrar este mozo",
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
        'No has borrado, el mozo',
        'error'
      )
    }
  })
})

</script>
@endsection
