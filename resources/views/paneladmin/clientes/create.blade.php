@extends('layouts.admin')
@section('content')
<section class="content-header">
  <div class="row">
    <div class="col-xs-12">
      <div class="box" style="background: #fcf4f480;border-radius: 13px;">
        <div class="box-header" style="text-align:center;">
          <i class="ion ion-person" aria-hidden="true" style="font-size: 63px;color: black;"></i>
          <br clear=all>
          <h2 class="box-title" style="font-weight: bold;color: black;font-size: 25px;">Cliente</h2>
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
                  <label for="exampleInputPassword1">Nombre</label>
                  <input class="form-control" placeholder="Ingrese Nombre" type="text" name="nombre"
                  @if(isset($cliente))
                  value="{{$cliente->nombre}}"
                  @else
                  required
                  @endif
                  >
                </div>
                <div class="col-md-6">
                  <label for="exampleInputEmail1">Email</label>
                  <input class="form-control" placeholder="ingrese email" type="email" name="email"
                  @if(isset($cliente))
                  value="{{$cliente->email}}"
                  @else
                  required
                  @endif
                  >
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-primary" style="float: right;color: white;background:black;border: none;font-weight: bold;">
              @if(isset($cliente))
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
