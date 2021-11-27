<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Estadia;
use App\EstadiaProducto;
class CocinaController extends Controller
{
    //

    public function index(){
      $cocina = User::where('rol','cocina')->first();
      return view('paneladmin.cocina.index',compact('cocina'));
    }

    public function panelcocina(){
      return view('panelcocina.gestion');
    }

    public function getpedidos(){
      $pedidos = Estadia::where('cocina','pendiente')->get();
      //dd($pedidos);
      $productos  = array('producto'=>[],
                          'cantidad'=>[]);
      foreach ($pedidos as $e) {
        $p = EstadiaProducto::find($e->id);
       // dd($p);
        //dd($productos);
        $productos['producto'][] = $p->nombre;
        $productos['cantidad'][] = $p->cantida;
        // code...
        $e['productos'] = $productos;
      }

      //$pedidos['productos'] = $productos;
      //dd($pedidos);
      return view('panelcocina.pedidos.index', compact('pedidos'));
    }




    public function pedido($id){
      $pedido = Estadia::find($id);
      $pedido->cocina = 'finalizado';
      $pedido->save();
       return redirect()->to('panelcocina');
    }

    public function create(){
      $datos = request()->all();
      $existe = User::where('rol','cocina')->first();
      $datos['rol'] = 'cocina';
      if($existe == null){
        $datos['password'] = bcrypt($datos['password']);
        $cocina = User::create($datos);
      }else{


        if($datos['password'] == ""){
          $datos['password'] = $existe->password;
        }else{
          $datos['password'] = bcrypt($datos['password']);
        }

        if($datos['email'] == ""){
          $datos['email'] = $existe->email;
        }

        if($datos['nombre'] == ""){
          $datos['nombre'] = $existe->email;
        }


        $existe->fill($datos);
        $existe->save();
       // dd($existe);
      }

      return redirect()->to('panel');
    }
}
