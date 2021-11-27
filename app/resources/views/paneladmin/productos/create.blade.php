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
          <i class="fa fa-glass" aria-hidden="true" ></i>
          <br clear=all>
          <h2 class="box-title" >PRODUCTO</h2>
        </div>
        <div class="box-body">
          <form role="form" method="POST">
              {{ csrf_field() }}
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input class="form-control" placeholder="Ingrese Nombre" type="text" name="nombre"
                    @if(isset($producto))
                    value="{{$producto->nombre}}"
                    @else
                    required
                    @endif>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Categoria</label>
                    <select name="categoria" class="form-control" required>
                      @if(isset($producto))
                      <option value="{{$producto->categoria}}" selected>{{$producto->nombrecategoria}}</option>
                      @else
                      <option value=""  >Seleccione categoria</option>
                      @endif
                      @foreach($categorias as $c)
                      <option value="{{$c->id}}">{{$c->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Proveedor</label>
                    <select name="proveedor" class="form-control" required>
                      @if(isset($producto))
                      <option value="{{$producto->proveedor}}">{{$producto->nombreproveedor}}</option>
                      @else
                      <option  value="">Seleccrione proveedor</option>
                      @endif
                      @foreach($proveedores as $p)
                      <option value="{{$p->id}}">{{$p->razonsocial}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Venta</label>
                    <select name="tipo" class="form-control" required>
                      @if(isset($producto))
                      <option value="{{$producto->tipo}}">{{$producto->tipo}}</option>
                      @else
                      <option value="">Seleccione tipo</option>
                      @endif
                        <option value="unitario">unidad</option>
                        <option value="litros">litros</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Stock Minimo</label>
                    <input class="form-control" placeholder="ingrese stock minima" type="number" name="unidadminima"
                    @if(isset($producto))
                    value="{{$producto->unidadactuales}}"
                    @else
                    required
                    @endif
                  >
                  </div>
                </div>
                <br clear=all>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputEmail1">Detalle</label>
                    <textarea name="descripcion" class="form-control" name="descripcion">@if(isset($producto)) {{$producto->descripcion}} @endif</textarea>
                  </div>
                </div>
              </div>
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
@endsection
