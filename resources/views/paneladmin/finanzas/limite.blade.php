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
<section class="content-header">
  <div class="row">
    <div class="col-xs-12">
     


           <div class="box fondo" >
        <div class="box-header fondohear" >
          <i class="fa fa-money" aria-hidden="true" ></i>
          <br clear=all>
          <h2 class="box-title" >LIMITE</h2>
        </div>
       
        <div class="box-body">
          <form role="form" method="POST">
            {{ csrf_field() }}

            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="id" value="{{$limite->id}}">
                  <input type="hidden" name="actual" value="{{$limite->actual}}">
                  <label for="exampleInputPassword1">Limite</label>
                  <input class="form-control" placeholder="Ingrese Limite a facturar" type="number" name="limite" step="0.001" 
                  value="{{$limite->limite}}"
                  >
                </div>
                
              </div>

            </div>
            <button type="submit" class="btn btn-primary btnctm" >
              Actualizar
               </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
