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
        <h2 class="box-title" >MESA</h2>
      </div>

        <div class="box-body">
          <form role="form" method="POST">
            {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputPassword1">Categoria</label>
                  <select name="categoria" class="form-control" id="categoria">
                    <option>selecione categoria</option>
                    @foreach($categorias as $c)
                    <option value="{{$c->id}}">{{$c->nombre}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-9">
                  <label for="exampleInputPassword1">Producto</label>
                  <select name="producto" class="form-control" id="producto">
                    <option default value="">Selecione producto</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="exampleInputEmail1">Cantidad</label>
                  <input class="form-control" placeholder="Cantidad" type="number" name="cantidad" id="cantidad">
                </div>

                <br clear="all">
                <div class="col-md-12">
                  <textarea name="descripcion" class="form-control" id="descripcion"></textarea>
                </div>
                <br clear="all">
                <div class="col-md-12">
                  <a   id="addbebeida" class="btn btn-primary btnctm" style="margin-top:30px;">AGREGAR</a>
                </div>
              </div>
              <br clear=all>
              <div class="col-md-12" style="color: white;font-weight: bold;text-transform: uppercase;">
                <h3 style="font-weight:bold;">Detalle:</h3>
              <div  id="listaproductos" style=""></div>
              @if(isset($estadiaedit))
                @foreach($estadiaedit['productos'] as $p)
                <div class="row">
                  <div class="col-md-1">
                     CANTIDAD: {{$p->cantida}}
                  </div>
                  <div class="col-md-10">
                    PRODUCTO: {{$p->nombre}}
                  </div>
                  <div class="col-md-1">
                    PRECIO: ${{$p->monto}}
                  </div>
                </div>
                @endforeach
              @endif
            </div>
              <h3 style="color: red;
    text-transform: uppercase;
    font-weight: bold;
    text-align: end;">Total $ <span id="total"> @if(isset($estadiaedit)) {{$estadiaedit->monto}} @endif</span></h3>
              <input type="hidden" name=total value=0 id="totalestadia">
            <button type="submit" class="btn btn-primary btnctm" >
              @if(isset($cliente))
              ACTUALIZAR
              @else
              CONFIRMAR
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
  precio = 0
  total = 0
  pos = 0
  @if(isset($estadiaedit))
  total = {{$estadiaedit->monto}};
  @endif
});

$('#categoria').change(function(e) {
  e.preventDefault()
  id = $(this).val()
  if(id != "selecione categoria"){
    $('#producto').empty()
    $.get('{{url("panelmozo/tomar/productos")}}'+'/'+id, function(res){
      html = '<option default value="">Selecione producto</option>'
      for(i=0;i<res.total;i++){
        html+='<option value='+res.productos[i].id+' '
        html+='data-precio='+res.productos[i].precioventa+' >'
        html+=res.productos[i].nombre
        html+='</option>'
      }
      $('#producto').append(html)
    })
  }

})


$('#producto').change(function(e) {
  e.preventDefault()
  precio = parseFloat($('#producto option:selected').data('precio'))
})

function borrar(id){
  location.reload();
}



$('#addbebeida').click(function(){
  if($('#producto').val() != "" && $('#cantidad').val()!= ""){
      subtotal = $('#cantidad').val()
      total += parseFloat(precio) * parseFloat($('#cantidad').val())

      html ='<div class="row">'
      html += '<div class="col-md-2">'
      html += 'CANTIDAD: '
      html += $('#cantidad').val()
      html += '</div>'
      html +='<div class="col-md-6">'
      html += '<input type=hidden name="listacantidades[]" value='+$('#cantidad').val()+'>'
      html +='<input type=hidden name="listaproductos[]" value='+$('#producto').val()+'>'
      html +='<input type=hidden name="listadescripcion[]" value="'
      +$('#descripcion').val()+'" >'
      html += 'PRODUCTO: '
      html += $('#producto option:selected').text()
      html += '</div>'
      html += '<div class="col-md-2">'
      html += 'PRECIO $:'
      html += precio
      html +='</div>'
      html +='<div class=col-md-12>'
      html += $('#descripcion').val()
      html += '</div>'
      html +='<div class="col-md-2">'
      html += '<a href=""   class=borrarvista '
      html += 'data-precio='+precio+' '
      html += 'data-subtotal='+parseFloat(precio) * parseFloat($('#cantidad').val())+' '
      html += 'data-cantidad='+$('#cantidad').val()+' >'
      html +='<i class="fa fa-trash" style="background: #ec0d34;color: white;font-size: 27px;border-radius: 3px;"></i>'
      html +='</a>'
      html +='</div>'
      html +='</div>'
      $('#total').empty()
      $('#total').append(total)
      $('#totalestadia').val(total)
      html +='<br clear=all>'
      pos++



      $('#listaproductos').append(html)
      $('#cantidad').val(1)
      $('#descripcion').val(' ')

      $('#borrarvista').click(function(rr){
        console.log('cambios financiero')
      })
    }
})
function myFunction(id){
  console.log(id,$(this).val())
  console.log($('#'+id).val())
  console.log('fin')
}
</script>
@endsection
