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
          <h2 class="box-title" >DISTRIBUCION</h2>
        </div>
        <div class="box-body">
          <form role="form" method="POST">
              {{ csrf_field() }}
              <div class="box-body">

                <div class="row">

                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Mozos</label>
                    <select name="mozo" class="form-control" required>
                      @if(isset($asignacion))
                      <option value="{{$asignacion->mozo}}" selected>{{$asignacion->nombremozo}}</option>
                      @else
                      <option value=""  >Seleccione Mozo</option>
                      @endif
                      @foreach($mozos as $c)
                      <option value="{{$c->id}}">{{$c->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Mesas</label>
                    <select name="mesa" class="form-control" required>
                      @if(isset($asignacion))
                      <option value="{{$asignacion->mesa}}" selected>{{$asignacion->nombremesa}}</option>
                      @else
                      <option value=""  >Seleccione Mesa</option>
                      @endif
                      @foreach($mesas as $c)
                      <option value="{{$c->id}}">{{$c->nombre}}</option>
                      @endforeach
                    </select>
                  </div>


                </div>

              </div>
              <br clear=all>
              <button type="submit" class="btn btn-primary btnctm">
                @if(isset($asignacion))
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
