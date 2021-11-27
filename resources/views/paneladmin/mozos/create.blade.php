@extends('layouts.admin')
@section('content')
<section class="content-header">
  @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif
  <div class="row">
    <br clear=all>
    <br clear=all>
    <div class="col-xs-12">
      <div class="box" style="background: #407759;border-radius: 10px;border: 2px solid white;">
        <div class="box-header" style="text-align:center;">
          <i class="fa fa-users" aria-hidden="true" style="font-size: 63px;color: white;"></i>
          <br clear=all>
          <h2 class="box-title" style="font-weight: bold;color: white;font-size: 25px;">MOZO</h2>
        </div>

        <div class="box-body">
          <form role="form" method="POST">
            {{ csrf_field() }}

            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <label style="color:white;text-transform:uppercase;font-size:18px;" >Nombre</label>
                  <input class="form-control" placeholder="Ingrese Nombre" type="text" name="nombre"
                  @if(isset($mozo))
                  value="{{$mozo->nombre}}"
                  @else
                  required
                  @endif
                  >
                </div>
                <div class="col-md-6">
                  <label style="color:white;text-transform:uppercase;font-size:18px;" >Email</label>
                  <input class="form-control" placeholder="ingrese email" type="email" name="email"
                  @if(isset($mozo))
                  value="{{$mozo->email}}"
                  @else
                  required
                  @endif
                  >
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label style="color:white;text-transform:uppercase;font-size:18px;" >Direccion</label>
                  <input class="form-control" placeholder="ingrese direccion" type="text" name="direccion"
                  @if(isset($mozo))
                  value="{{$mozo->direccion}}"
                  @else
                  required
                  @endif
                  >
                </div>
                <div class="col-md-6">
                  <label style="color:white;text-transform:uppercase;font-size:18px;" >Telefono</label>
                  <input class="form-control" placeholder="ingrese telefono" type="text" name="telefono"
                  @if(isset($mozo))
                  value="{{$mozo->telefono}}"
                  @else
                  required
                  @endif
                  >
                </div>
              </div>
              <br clear=all>
              <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                  <label style="color:white;text-transform:uppercase;font-size:18px;" >Password</label>
                  <input class="form-control" placeholder="Password" type="password" name="password"
                  @if(!isset($mozo))
                  required
                  @endif
                  >
                </div>
              </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" style="float: right;color: white;background: #294837;font-weight: bold;border: 1px solid;font-size: 15px;">
              @if(isset($mozo))
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
