<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Mesas;
use App\Estadia;
use App\EstadiaProducto;
use App\Producto;
use Carbon\Carbon;
use App\Categoria;
Use App\MesaMozo;
use Auth;
use Session;

class PanelMozoController extends Controller
{

  public function mesas(){
      $mesas = MesaMozo::where('mozo',Auth::user()->id)->orderBy('mesa')->get();
      foreach ($mesas as $m) {
        $date = Carbon::now();
        $mesa =Mesas::find($m->mesa);
        $m['nombre'] = $mesa->nombre;
        /*
        $estadia = Estadia::where('mesa',$mesa->nombre)
        ->where('fecha',$date->format('Y-m-d'))
        ->where('estado','<>','finalizado')->get();
        */
        $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->count();
        //dd($estadia);
        /*if(count($estadia) > 1){
          $idsborrar = [];
          for($i=0;$i< count($estadia)-1;$i++){
            $idsborrar[] = $estadia[$i]->id;
          }
          foreach ($idsborrar as $i) {
            $estadia = Estadia::find($i);
            $estadia->estado = 'finalizado';
            $estadia->save();
          }
          $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->first();
        }else{
          $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->first();
        }*/

        if($estadia == 0){
          $m['estado'] = "disponible";
        }else{
          $m['estado'] = "ocupada";
          $m['estadia'] = $estadia[0];
        }
      }
      return view('panelmozo.index',compact('mesas'));
    }

    public function esperando($id){

      $estadia = Estadia::find($id);
      if($estadia->estado == "esperando"){
        Session::flash('mensaje','Esta mesa Fue cerrada, hable con la encargada de la barra');
        return redirect()->to('panelmozo/mesas');
      }
      $estadia->estado = 'esperando';
      $estadia->save();
      return redirect()->to('panelmozo/mesas');
    }

    public function tomar($id){
      $categorias = Categoria::all();
      $mesasibres = Mesas::all();
      foreach ($mesasibres as $key => $m) {
        $estadia = Estadia::where('mesa',$m->nombre)->where('estado','proceso')->count();
        if($estadia != 0){
          unset($mesasibres[$key]);
        }
      }
      return view('panelmozo.mesa.index', compact('categorias','mesasibres','id'));
    }

    public function getProductos($id){
      $productos = Producto::where('categoria',$id)
      ->where('precioventa','>',0)->where('unidadactuales','>',0)->get();
      //dd($productos);
      return array('resp'=>'success','productos'=>$productos,'total'=>count($productos));
    }

    public function registrar(Request $request,$id){
      $this->validate($request,[
        '_token'=>['required'],
        'listaproductos'=>['required']
      ]);
      $datos = request()->all();

      $mesa = MesaMozo::find($id);
      $mesa = Mesas::find($mesa->mesa);

      $cocina = array('producto'=>[],
                      'cantidad'=>[],
                      'descripcion'=>[]
                    );
      $bebida = array('producto'=>[],
                      'cantidad'=>[]);
      foreach ($datos['listaproductos'] as $k => $value) {
        $producto = Producto::find($value);
        if($producto->unidadactuales < $datos['listacantidades'][$k] ){
          Session::flash('mensaje','No Hay unidades sufientes para la ventas de '.$producto->nombre);
          return redirect()->to('panelmozo/mesas');
        }
        $producto->unidadactuales = $producto->unidadactuales - (int)$datos['listacantidades'][$k];
        $producto->save();
        $categoria = Categoria::find($producto->categoria);
        if($categoria->cocina == "si"){
          $cocina['producto'][] = $producto->nombre;
          $cocina['cantidad'][] = $datos['listacantidades'][$k];
          $cocina['descripcion'][] = $datos['listadescripcion'][$k];
        }else{
          $bebida['producto'][] = $producto->nombre;
          $bebida['cantidad'][] = $datos['listacantidades'][$k];
        }
      }
      $date = Carbon::now();
      date_default_timezone_set('America/Argentina/Cordoba');
      $estadia = Estadia::create(array(
        'mozo'=>Auth::user()->id,
        "mesa"=> $mesa->nombre,
        'fecha'=> $date->format('Y-m-d'),
        'monto' =>$datos['total'],
        'estado'=>'ocupada',
        'ticketcomida'=>json_encode($cocina),
        'ticketbebida'=> json_encode($bebida),
        'bebida'=>(count($bebida['producto'])>0)?true:false,
        'comida'=>(count($cocina['producto'])>0)?true:false,
        'cocina'=>(count($cocina['cantidad'])>0)?'pendiente':'norequerido'
      ));

      foreach ($datos['listaproductos'] as $k=>$p) {
        $producto = Producto::find($p);
        $es = EstadiaProducto::create(array(
          'estadia'=>$estadia->id,
          'cantida'=>(int)$datos['listacantidades'][$k],
          'nombre'=>$producto->nombre,
          'monto'=>$datos['listacantidades'][$k]*$producto->precioventa
        ));
      }
      return redirect()->to('panelmozo');
    }

    public function agregarproductos($id){
      $mesamozo = MesaMozo::find($id);
      $mesaedit = Mesas::find($mesamozo->mesa);

      $date = Carbon::now();

      $estadia = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->get();
      if(count($estadia) > 1){
        $idsborrar = [];
        for($i=0;$i< count($estadia)-1;$i++){
          $idsborrar[] = $estadia[$i]->id;
        }
        foreach ($idsborrar as $i) {
          $estadia = Estadia::find($i);
          $estadia->estado = 'finalizado';
          $estadia->save();
        }
        $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->first();
      }else{
        $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->first();
      }

      /*
      $estadias = Estadia::where('mesa',$mesaedit->nombre)
      ->where('estado','<>','finalizado')->count();

      if($estadias > 1){
        $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)
      ->where('estado','<>','finalizado')->where('fecha', date('Y-m-d'))->first();
      }else{
        $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)
      ->where('estado','<>','finalizado')->first();
    }*/


      $categorias = Categoria::all();
      $estadiaproducto = EstadiaProducto::where('estadia',$estadiaedit->id)->get();
      $estadiaedit['productos'] = $estadiaproducto;
      $mesaedit = Mesas::where('nombre',$estadiaedit->mesa)->first();
      $estadiaedit['idmesa'] = $mesaedit->id;
      $productos = Producto::all();
      $mesasibres = Mesas::all();
      foreach ($mesasibres as $key => $m) {
        $estadia = Estadia::where('mesa',$m->nombre)->where('estado','proceso')->count();
        if($estadia != 0){
          unset($mesasibres[$key]);
        }
      }
      return view('panelmozo.mesa.index',compact('categorias','estadiaedit','productos','mesasibres','id'));
    }

    public function delete($id,$id2){
      $estadiaproducto = EstadiaProducto::find($id);
      $mesamozo = MesaMozo::find($id2);
      $mesaedit = Mesas::find($mesamozo->mesa);
      $date = Carbon::now();

      $estadia = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->get();
      if(count($estadia) > 1){
        $idsborrar = [];
        for($i=0;$i< count($estadia)-1;$i++){
          $idsborrar[] = $estadia[$i]->id;
        }
        foreach ($idsborrar as $i) {
          $estadia = Estadia::find($i);
          $estadia->estado = 'finalizado';
          $estadia->save();
        }
        $estadia = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->first();
      }else{
        $estadia = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->first();
      }
      /*
      $estadia = Estadia::where('mesa',$mesaedit->nombre)
      ->where('fecha',$date->format('Y-m-d'))
      ->where('estado','ocupada')->first();
      */
      $estadia->monto = $estadia->monto - $estadiaproducto->monto;
      $estadia->save();
      $estadiaproducto->delete();
      return redirect()->to('panelmozo/mozos/agregar/'.$id2);
    }

    public function guardarproductos(Request $request,$id){
      $datos = request()->all();
      $this->validate($request,[
        '_token'=>['required'],
        'listaproductos'=>['required']
      ]);
      date_default_timezone_set('America/Argentina/Cordoba');
      $mesamozo = MesaMozo::find($id);
      $mesaedit = Mesas::find($mesamozo->mesa);
      $date = Carbon::now();
      /*
      $estadia = Estadia::where('mesa',$mesaedit->nombre)
      ->where('estado','<>','finalizado')->count();

      if($estadia > 1){
        $estadia = Estadia::where('mesa',$mesaedit->nombre)
      ->where('estado','<>','finalizado')->where('fecha', date('Y-m-d'))->first();
      }else{
        $estadia = Estadia::where('mesa',$mesaedit->nombre)
      ->where('estado','<>','finalizado')->first();
      }
      */

      $estadia = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->get();
//dd($estadia);
      if(count($estadia) > 1){
        $idsborrar = [];
        for($i=0;$i< count($estadia)-1;$i++){
          $idsborrar[] = $estadia[$i]->id;
        }
        foreach ($idsborrar as $i) {
          $estadia = Estadia::find($i);
          $estadia->estado = 'finalizado';
          $estadia->save();
        }
        $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->first();
      }else{
        $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)->where('estado','<>','finalizado')->first();
      }
      $estadia = $estadiaedit;

      $date = Carbon::now();
      $monto = 0;
      $cocina = array('producto'=>[],
                      'cantidad'=>[],
                      'descripcion'=>[]
                    );
      $bebida = array('producto'=>[],
                      'cantidad'=>[]);

      foreach ($datos['listaproductos'] as $k => $value) {
        $producto = Producto::find($value);
        if($producto->unidadactuales < $datos['listacantidades'][$k] ){
          Session::flash('mensaje','No Hay unidades sufientes para la ventas de '.$producto->nombre);
          return redirect()->to('panelmozo/mesas');
        }
        $producto->unidadactuales = $producto->unidadactuales - (int)$datos['listacantidades'][$k];
        $producto->save();
        $categoria = Categoria::find($producto->categoria);
        if($categoria->cocina == "si"){
          $cocina['producto'][] = $producto->nombre;
          $cocina['cantidad'][] = $datos['listacantidades'][$k];
          $cocina['descripcion'][] = $datos['listadescripcion'][$k];
        }else{
          $bebida['producto'][] = $producto->nombre;
          $bebida['cantidad'][] = $datos['listacantidades'][$k];
        }
      }

      foreach ($datos['listaproductos'] as $k=>$p) {
        $producto = Producto::find($p);
        $monto += $datos['listacantidades'][$k]*$producto->precioventa;
        EstadiaProducto::create(array(
          'estadia'=>$estadia->id,
          'cantida'=>$datos['listacantidades'][$k],
          'nombre'=>$producto->nombre,
          'monto'=>$datos['listacantidades'][$k]*$producto->precioventa
        ));
      }

      $estadia->fill(array('ticketcomida'=>json_encode($cocina),
        'ticketbebida'=> json_encode($bebida),
        'bebida'=>(count($bebida['producto'])>0)?true:false,
        'comida'=>(count($cocina['producto'])>0)?true:false,
        'cocina'=>(count($cocina['cantidad'])>0)?'pendiente':'norequerido',
        'monto'=>$estadia->monto + $monto
      ));

      $estadia->save();
      return redirect()->to('panelmozo');
    }

    public function vermesa($id){

      $mesamozo = MesaMozo::find($id);
      $mesaedit = Mesas::find($mesamozo->mesa);
      $date = Carbon::now();
      $estados = ['ocupada','esperando'];

      $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)
      ->whereIn('estado',$estados)->first();

    // dd($estadiaedit);
      $estadiaproducto = EstadiaProducto::where('estadia',$estadiaedit->id)->get();
      $estadiaedit['productos'] = $estadiaproducto;
     // dd($mesaedit,$estadiaproducto);
      $mesaedit = Mesas::where('nombre',$estadiaedit->mesa)->first();
     // dd($mesaedit);
      $estadiaedit['idmesa'] = $mesaedit->id;
      $productos = Producto::all();
      $mesasibres = Mesas::all();
      foreach ($mesasibres as $key => $m) {
        $estadia = Estadia::where('mesa',$m->nombre)->where('estado','proceso')->count();
        if($estadia != 0){
          unset($mesasibres[$key]);
        }
      }
     // dd($estadiaedit);
      return view('panelmozo.mesa.ver',compact('estadiaedit','id'));
    }

    public function cerrar($id){
      $estadia = Estadia::find($id);
      $estadia->estado = "esperando";
      $estadia->save();
      return redirect()->to('mozos');
    }

    public function previsualizar($id){
       $mesamozo = MesaMozo::find($id);
      $mesaedit = Mesas::find($mesamozo->mesa);
      $date = Carbon::now();
      $estados = ['estados','ocupada'];
      $estadiaedit = Estadia::where('mesa',$mesaedit->nombre)
      ->whereIn('estado',$estados)->first();
      $estadiaproducto = EstadiaProducto::where('estadia',$estadiaedit->id)->get();
      $estadiaedit['productos'] = $estadiaproducto;
      $mesaedit = Mesas::where('nombre',$estadiaedit->mesa)->first();

      $estadiaedit['idmesa'] = $mesaedit->id;
      $productos = Producto::all();
      $mesasibres = Mesas::all();
      foreach ($mesasibres as $key => $m) {
        $estadia = Estadia::where('mesa',$m->nombre)->where('estado','proceso')->count();
        if($estadia != 0){
          unset($mesasibres[$key]);
        }
      }
      $cerrar = 'cerrar';
      return view('panelmozo.mesa.ver',compact('estadiaedit','id','cerrar'));
    }
}
