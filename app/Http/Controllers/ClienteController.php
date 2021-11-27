<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cliente;
use Session;
class ClienteController extends Controller
{
    public function index(){
      $clientes = Cliente::all();
      return view('paneladmin.clientes.index',compact('clientes'));
    }

    public function indexcreate(){
      return view('paneladmin.clientes.create');
    }

    public function create(Request $request){
      $this->validate($request,[
        "_token" => ["required"],
        "nombre" => ["required"],
        "email" =>  ["required"],
      ]);
      $datos = request()->all();
      $existe = $this->validatecliente(null,$datos,'crear');

      if($existe->estado == false){
        $cliente = Cliente::create($datos);
        return redirect()->to('panel/clientes');
      }
      Session::flash('message',$existe->mensaje);
      Session::flash('alert-class', 'alert-danger');
      return redirect()->to('panel/clientes/crear');
    }

    public function edit($id){
      $cliente = Cliente::find($id);
      return view('paneladmin.clientes.create',compact('cliente'));
    }

    public function save($id){
      $datos = request()->all();
      $existe = $this->validatecliente($id,$datos,'actualizar');
      if($existe->estado == false){
        $cliente = Cliente::find($id);
        $cliente->fill($datos);
        $cliente->save();
        return redirect()->to('panel/clientes');
      }
      Session::flash('message',$existe->mensaje);
      Session::flash('alert-class', 'alert-danger');
      return redirect()->to('panel/clientes/crear');
    }

    public function delete($id){
      $cliente = Cliente::find($id);
      $cliente->delete();
      return array('estado'=>true);
    }

    private function validatecliente($id,$datos,$accion){
      if($accion == "crear"){
        $email = Cliente::where('email',$datos['email'])->count();
        $nombre = Cliente::where('nombre',$datos['nombre'])->count();
      }else{
        $email = Cliente::where('email',$datos['email'])->where('id','<>',$id)->count();
        $nombre = Cliente::where('nombre',$datos['nombre'])->where('id','<>',$id)->count();
      }

      if($email == 0 && $nombre == 0){
        $respuesta = (object)array(
          'estado'=>false,
          'mensaje'=>''
        );
      }else{
        if($email != 0 && $nombre != 0){
          $respuesta = (object)array(
            'estado'=>true,
            'mensaje'=>'El Email y el Nombre, ya se encuntran registrado en la base de datos'
          );
        }else{
          if($email != 0){
            $respuesta = (object)array(
              'estado'=>true,
              'mensaje'=>'El Email ya se encuntran registrado en la base de datos'
            );
          }

          if($nombre != 0){
            $respuesta = (object)array(
              'estado'=>true,
              'mensaje'=>'El Nombre, ya se encuntran registrado en la base de datos'
            );
          }
        }
      }

      return $respuesta;

    }
}
