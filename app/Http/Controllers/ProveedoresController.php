<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Proveedor;
use Session;

class ProveedoresController extends Controller
{
    //
    public function index(){
      $proveedores = Proveedor::all();
      return view('paneladmin.proveedores.index',compact('proveedores'));
      dd(request()->all());
    }

    public function indexcreate(){
      return view('paneladmin.proveedores.create');
    }

    public function create(Request $request){
      $this->validate($request,[
        "razonsocial" => ["required"],
        "nombre" => ["required"],
        "direccion" => ["required"],
        "telefono" => ["required"],
        "email" => ["required"],
        "_token"=>["required"]
      ]);

      $datos =request()->all();
      $existe = $this->existeproveedor(null,$datos,'crear');
      if($existe->estado == false){
        Proveedor::create($datos);
        return redirect()->to('panel/proveedores');
      }

      Session::flash('message',$existe->mensaje);
      Session::flash('alert-class', 'alert-danger');
      return redirect()->to('panel/proveedores/crear');


      /*




      'nombre',
      'razonsocial',
      'email',
      'direccion',
      'telefono'

      */



    }

    public function edit($id){
      $proveedor = Proveedor::find($id);
      return view('paneladmin.proveedores.create',compact('proveedor'));
    }

    public function save($id){
      $datos = request()->all();
      $existe = $this->existeproveedor($id,$datos,'actualizar');
      if($existe->estado == false){
        $proveedor = Proveedor::find($id);
        $proveedor->fill($datos);
        $proveedor->save();
        return redirect()->to('panel/proveedores');
      }

      Session::flash('message',$existe->mensaje);
      Session::flash('alert-class', 'alert-danger');
      return redirect()->to('panel/proveedores/crear');
    }

    public function delete($id){
      $proveedor = Proveedor::find($id);
      $proveedor->delete();
      return array('success'=>'ok');
    }

    private function existeproveedor($id,$datos,$tipo){

      if($tipo == "crear"){
        $razonsocial = Proveedor::where('razonsocial',$datos['razonsocial'])->count();
        $email = Proveedor::where('email',$datos['email'])->count();
      }else{
        $razonsocial = Proveedor::where('razonsocial',$datos['razonsocial'])->where('id','<>',$id)->count();
        $email = Proveedor::where('email',$datos['email'])->where('id','<>',$id)->count();
      }

      if($email == 0 && $razonsocial == 0){
        $respuesta = (object)array(
          'estado'=>false,
          'mensaje'=>''
        );
      }else{
        if($email != 0 && $razonsocial != 0){
          $respuesta = (object)array(
            'estado'=>true,
            'mensaje'=>'El email y la razonsocial, se encuentran en uso'
          );
        }else{
          if($email!=0)
            $respuesta = (object)array(
              'estado'=>true,
              'mensaje'=>'El email, se encuentran en uso'
            );

          if($razonsocial !=0)
            $respuesta = (object)array(
              'estado'=>true,
              'mensaje'=>'La razon social, se encuentra en uso'
            );
          }
      }
      return $respuesta;
    }
}
