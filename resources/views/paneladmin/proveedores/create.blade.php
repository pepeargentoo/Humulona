@extends('layouts.admin')
@section('content')
<style>
  label{
    color:white;
    text-transform:uppercase;
    font-size:18px;
  }
</style>
<section class="content-header">
  <br clear=all>
  <br clear=all>
  <div class="row">
    @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="col-xs-12">
      <div class="box" style="background: #407759;border-radius: 10px;border: 2px solid white;">
        <div class="box-header" style="text-align:center;">
          <i class="fa fa-cubes" aria-hidden="true" aria-hidden="true" style="font-size: 63px;color: white;"></i>
          <br clear=all>
          <h2 class="box-title" style="font-weight: bold;color: white;font-size: 25px;">PROVEEDOR</h2>
        </div>
        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="box-body">

          <form role="form" method="POST">
                   {{ csrf_field() }}
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Razon Social</label>
                    <input class="form-control" placeholder="Ingrese Razon Social" type="text" name="razonsocial"
                    @if(isset($proveedor))
                    value="{{$proveedor->razonsocial}}"
                    @else
                    required
                    @endif>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input class="form-control" placeholder="Ingrese Nombre" type="text" name="nombre"
                    @if(isset($proveedor))
                    value="{{$proveedor->nombre}}"
                    @else
                    required
                    @endif>
                  </div>
                </div>
                <br clear=all>
                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Direccion</label>
                    <input class="form-control" placeholder="ingrese direccion" type="text" name="direccion"
                    @if(isset($proveedor))
                    value="{{$proveedor->direccion}}"
                    @else
                    required
                    @endif>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputPassword1">Telefono</label>
                    <input class="form-control" placeholder="ingrese telefono" type="text" name="telefono"
                    @if(isset($proveedor))
                    value="{{$proveedor->telefono}}"
                    @else
                    required
                    @endif>
                  </div>
                </div>
                <br clear=all>
                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputEmail1">Email</label>
                    <input class="form-control" placeholder="ingrese email" type="email" name="email"
                    @if(isset($proveedor))
                    value="{{$proveedor->email}}"
                    @else
                    required
                    @endif
                  >
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="float: right;color: white;background: #294837;font-weight: bold;border: 1px solid;font-size: 15px;">
                @if(isset($proveedor))
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
