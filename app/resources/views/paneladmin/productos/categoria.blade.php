@extends('layouts.admin')
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

table thead{
  background:black;color:white;text-transform:uppercase;
}

</style>
@if(Session::has('message'))
  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<section class="content-header">
  <br clear=all>
  <br clear=all>

  <div class="row">
    <div class="col-xs-12">
      <div class="box fondo" >
        <div class="box-header fondohear" >
          <i class="fa fa-folder-open-o" aria-hidden="true" style=""></i>
          <br clear=all>
          <h2 class="box-title" >CATEGORIA</h2>
        </div>

        <div class="box-body">
          <form role="form" method="POST">
            {{ csrf_field() }}

            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <label >Nombre</label>
                  <input class="form-control" placeholder="Ingrese Nombre" type="text" name="nombre"
                  @if(isset($categoria))
                  value="{{$categoria->nombre}}"
                  @else
                  required
                  @endif
                  >
                </div>
                <div class="col-md-12">
                  <label>COCINA</label>
                  <select name="cocina" class="form-control"
                  @if(!isset($categoria))
                  required
                  @endif
                   >
                    <option value="">PERTENECE A LA COCINA</option>
                    <option value="si"
                     @if(isset($categoria))
                      @if($categoria->cocina = "si")
                        selected="selected"
                      @endif
                     @endif
                    >SI</option>
                    <option value="no"
                    @if(isset($categoria))
                      @if($categoria->cocina = "no")
                        selected="selected"
                      @endif
                     @endif
                    >NO</option>
                  </select>
                </div>
                <div class="col-md-12">
                  <label >Descripcion</label>
                  <textarea name="descripcion" class="form-control">@if(isset($categoria)){{$categoria->descripcion}}@endif</textarea>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btnctm" >
              @if(isset($cliente))
              Actualizar
              @else
              CREAR
              @endif
            </button>
          </form>
        </div>


    <br clear=all>
    <div class="col-md-12">
      <table id="myTable" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Datos del Categoria</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categorias as $c)
        <tr>
        <td  style="width:80%;">
          <p style="margin: 0px;"><span style="font-weight: bold;">Nombre: </span>{{$c->nombre}}</p>
          <p style="margin: 0px;"><span style="font-weight: bold;">Descripcion: </span>{{$c->descripcion}}</p>
      </td>
        <td>
          <a href="{{url('panel/productos/categorias/edit',[$c->id])}}">
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

    <br clear=all>
    <br clear=all>
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
  url = "{{url('panel/productos/categorias/delete')}}"+'/'+id
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Borrar categoria',
    text: "Esta seguro que desea borrar esta categoria",
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
        'No has borrado, la categoria',
        'error'
      )
    }
  })
})

</script>
@endsection
