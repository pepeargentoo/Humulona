<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesas;
use App\Http\Requests;
use Session;

class MesaController extends Controller
{
    public function index(){
      $mesas = Mesas::all();
      return view('paneladmin.mesas.index',compact('mesas'));
    }

    public function indexcreate(){
      return view('paneladmin.mesas.create');
    }

    public function create(){

      $datos = request()->all();
      $existe = $this->exite(0,$datos,"crear");
      if($existe->estado == true){
        Session::flash('message', $existe->mensaje);
        Session::flash('alert-class', 'alert-danger');
        return redirect()->to('panel/mesas/crear');
      }
      $mesa = Mesas::create($datos);
      return redirect()->to('panel/mesas');
    }

    public function edit($id){
      $mesa = Mesas::find($id);
      return view('paneladmin.mesas.create',compact('mesa'));
    }

    public function save($id){
      $datos = request()->all();
      $existe = $this->exite($id,$datos,"actualizar");
      if($existe->estado == true){
        Session::flash('message', $existe->mensaje);
        Session::flash('alert-class', 'alert-danger');
        return redirect()->to('panel/mesas/crear');
      }

      $mesa = Mesas::find($id);
      $mesa->fill($datos);
      $mesa->save();
      return redirect()->to('panel/mesas');
    }

    public function delete($id){
      $mesa = Mesas::find($id);
      $mesa->delete();
      return array('estado'=>true);
    }

    public function panelgestion(){
      return view('paneladmin.gestion');
    }

    public function listadodemesas(){
      $mesas = Mesas::all();
      return view('paneladmin.mesas.estadomesas',compact('mesas'));
    }

    private function exite($id, $datos, $tipo){
      $respuesta = (object)array(
        'mensaje'=>'',
        'estado' => false
      );

      if($tipo == "crear"){
        $mesa = Mesas::where('nombre',$datos['nombre'])->count();
      }else{
        $mesa = Mesas::where('id','<>',$id)->where('nombre',$datos['nombre'])->count();
      }

      if($mesa != 0){
        $respuesta = (object)array(
          'mensaje'=>'La mesa ya se encuentra en uso',
          'estado' => true
        );
      }
      return $respuesta;
    }
}
