@extends('layouts.admin')
@section('content')
<style>
.fondo{
  background: #407759;
  border-radius: 10px;
  border: 2px solid white;
}
.fondohear{
  text-align:center;
}
.fondohear i{
  font-size: 63px !important;
  color: white;
}
.fondohear h2,.stock{
  font-weight: bold;
  color: white;
  font-size: 25px !important;
}
label{
  color:white;
  text-transform:uppercase;
  font-size:18px;
}

.btnctm{
  float: right;
  color: white;
  background: #294837;
  font-weight: bold;
  border: 1px solid;
  font-size: 15px;
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
          <i class="fa fa-shopping-bag" aria-hidden="true" ></i>
          <br clear=all>
          <h2 class="box-title" >COMPRA</h2>
        </div>
        <div class="box-body">
          <form role="form" method="POST">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputEmail1">Proveedores</label>
                    <select name="proveedores" class="form-control"  id="proveedor" required>
                      <option value=""  >Seleccione Proveedor</option>
                      @foreach($proveedores as $p)
                      <option value="{{$p->id}}"
                        @if(isset($compras))
                          @if($compras->proveedores == $p->id)
                            selected=selected
                          @endif
                        @endif
                        >{{$p->razonsocial}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="exampleInputPassword1">Articulo</label>
                    <input class="form-control" placeholder="Ingrese Articulo" type="text" id="articulo">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputPassword1">cantidad</label>
                    <input class="form-control" placeholder="Ingrese cantidad" type="number" id="cantidad">
                  </div>
                  <div class="col-md-3">
                    <label for="exampleInputPassword1">precio</label>
                    <input class="form-control" placeholder="Ingrese precio" type="number" id="precio" step=0.001>
                  </div>
                  <div class="col-md-1">
                    <a href="#" class="btn btn-primary btnctm" style="margin-top: 31px;" id="btncompra">Agregar</a>
                  </div>
                </div>
                <br clear=all>
                <table class="table table-bordered table-hover" style="color:white;">
                  <thead>
                    <th>Cantidad</th>
                    <th>Articulo</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                  </thead>
                  <tbody id="tablacompra">
                  </tbody>
                </table>
                <br  clear=all>
                <h2>Total: $<input  id="total"  style="background: no-repeat;border: none;" name="total"
                  @if(isset($compras))
                  value="{{$compras->monto}}"
                  @else
                  value="0"
                  @endif
                  ></h2>
                <br clear=all>
                <h2 class="stock" >STOCK</h2>
                <br clear=all>
                <div class="col-md-8">
                  <label for="exampleInputEmail1">Producto</label>
                  <select name="" class="form-control"  id="producto">
                    <option value=""  >Seleccione Producto</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="exampleInputPassword1">cantidad</label>
                  <input class="form-control" placeholder="Ingrese Cantidad" type="number"
                  id="cantidadproducto"
                  >
                </div>
                <div class="col-md-1">
                  <a href="#" class="btn btn-primary btnctm" style="margin-top: 31px;" id="btnproducto">Agregar</a>
                </div>
                <br clear=all>
                <br clear=all>
                <table class="table table-bordered table-hover" style="color:white;">
                  <thead>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Accion</th>
                  </thead>
                  <tbody id="listadeproducto">

                  </tbody>
                </table>
              </div>
              <br clear=all>
              <button type="submit" class="btn btn-primary btnctm">
                @if(isset($producto))
                Actualizar
                @else
                CREAR
                @endif
              </button>
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
$( document ).ready(function() {
  total = 0;
})
$('#proveedor').change(function(e){
  e.preventDefault();
  $.get('{{url("panel/compras/productos")}}'+'/'+$(this).val(),function(res){
    $('#producto').empty()
    html = '<option value="">Seleccione Producto</option>'
    for(i=0;i<res.length;i++){
      html += '<option value="'+res[i].id+'">'+res[i].nombre+'</option>'
    }
    $('#producto').append(html);
  })
})
$('#btncompra').click(function(e){
  e.preventDefault()
  articulo = $('#articulo').val()
  cantidad = $('#cantidad').val()
  precio = $('#precio').val()
  html = ''
  if(precio!="" && articulo != "" && cantidad !=""){
    subtotal = parseInt(cantidad)* parseFloat(precio)
    total = total + subtotal
    html += '<tr>'
    html +='<td>'+cantidad
    html += '<input type=hidden name=cantidad[] value='+cantidad+'>'
    html +='</td>'
    html +='<td>'+articulo
    html += '<input type=hidden name=articulo[] value="'+articulo+'">'
    html +='</td>'
    html+='<td>'+precio
    html+='<input type=hidden name=precio[] value='+precio+' >'
    html+='</td>'
    html +='<td>'+subtotal+'</td>'
    html +='<td>'
    html +='<a href="#" class="borrarcliente" data-total='+subtotal+' >'
    html +='<i class="fa fa-trash" style="background: #ec0d34;color: white;font-size: 27px;border-radius: 3px;"></i>'
    html +='</a>'
    html +='</td>'
    html +='</tr>'
    $('#tablacompra').append(html);
    $('#articulo').attr('value', '')
    $('#cantidad').attr('value', '')
    $('#precio').attr('value', '')


    $('#total').val(total)
  }
  $('.borrarcliente').click(function(op){
    op.preventDefault()
  //  console.log($(this).data('total'))
  //  total = total - parseFloat($(this).data('total'))
    $(this).parent().parent().remove()
  //  $('#total').val(total)
  })
})

$('#btnproducto').click(function(e){
  e.preventDefault()
  $('#cantidadproducto').val()

  html = ''
  html += '<tr>'
  html += '<td>'+$('#cantidadproducto').val()
  html += '<input type=hidden name=productocantidad[] value='+$('#cantidadproducto').val()+' >'
  html +='</td>'

  html +='<td>'+$( "#producto option:selected" ).text();
  html += '<input type=hidden name=producto[] value='+$('#producto').val()+' >'
  html += '</td>'
  html +='<td>'
  html +='<a href="#" class="borrarproducto" >'
  html +='<i class="fa fa-trash" style="background: #ec0d34;color: white;font-size: 27px;border-radius: 3px;"></i>'
  html +='</a>'
  html +='</td>'
  html += '</tr>'
  $('#listadeproducto').append(html)
  $('.borrarproducto').click(function(op){
    op.preventDefault()
    $(this).parent().parent().remove()
  })
  //$('#listadeproducto').
})
</script>
@endsection
