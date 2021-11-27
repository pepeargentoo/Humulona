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
          <i class="fa fa-money" aria-hidden="true" ></i>
          <br clear=all>
          <h2 class="box-title" >GASTOS</h2>
        </div>
        <div class="box-body">
          <form role="form" method="POST">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="row">

                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Tipo</label>
                    <select name="tipo" class="form-control" required>
                      @if(isset($gastos))
                    
                      @if($gastos->tipo == "sueldo")
                        <option value=""  >Seleccione categoria</option>
                        <option value="sueldo" selected>SUELDO</option>
                        <option value="gastos">GASTOS</option>
                      @else
                      <option value=""  >Seleccione categoria</option>
                      <option value="sueldo">SUELDO</option>
                      <option value="gastos" selected>GASTOS</option>
                      @endif
                      @else
                      <option value=""  >Seleccione categoria</option>
                      <option value="sueldo">SUELDO</option>
                      <option value="gastos">GASTOS</option>
                      @endif

                    </select>
                  </div>

                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Monto</label>
                    <input class="form-control" placeholder="monto" type="number" step=0.001 name="monto"
                    @if(isset($gastos))
                    value="{{$gastos->monto}}"
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
                    <textarea name="descripcion" class="form-control" name="descripcion">@if(isset($gastos)) {{$gastos->descripcion}} @endif</textarea>
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
