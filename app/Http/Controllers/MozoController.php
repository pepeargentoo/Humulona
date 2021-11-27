<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\MesaMozo;

use App\Mesas;
use Session;


class MozoController extends Controller
{

    public function index(){

      $mozos = User::where('rol','mozo')->get();
      return view('paneladmin.mozos.index', compact('mozos'));
    }

    public function panelmozo(){
      return view('panelmozo.gestion');
    }

    public function asignacionindex(){
      $districucion = MesaMozo::all();
      foreach ($districucion as $d) {
        $mozo = User::find($d->mozo);
        if($mozo != null){

          $mesa = Mesas::find($d->mesa);
          if($mesa != null){
            $d['nombremozo'] = $mozo->nombre;
            $d['nombremesa'] = $mesa->nombre;
            //dd($mesa,$d);
          }

        }
      //  dd($mozo);

      }
      return view('paneladmin.asignacion.index',compact('districucion'));
    }

    public function asignacionindexcreate(){
      $mesas = Mesas::all();

      $mozos = User::where('rol','mozo')->get();
      return view('paneladmin.asignacion.create',compact('mesas','mozos'));
    }

    public function asignacioncreate(){
      $datos = request()->all();
      $existe = MesaMozo::where('mozo',$datos['mozo'])->where('mesa',$datos['mesa'])->get();
      if(count($existe)  == 0){
        $mesayaasignada = MesaMozo::where('mesa',$datos['mesa'])->get();
        if(count($mesayaasignada) == 0){
          MesaMozo::create($datos);
        }else{
          Session::flash('mensaje','Esta mesa ya esta asignada a otro mozo');
        }
      }else{
        Session::flash('mensaje','Este mozo ya tiene asignada la mesa');
      }
      return redirect()->to('panel/asignacion');
    }

    public function asignaciondelete($id){
      $existe = MesaMozo::find($id);
      if($existe != null)
        $existe->delete();
      return array('succes'=>true);
    }

    public function asignacionedit($id){
        $asignacion = MesaMozo::find($id);
        if($asignacion == null){
          Session::flash('mensaje','Esta asignacion no existe en el sistema');
          return redirect()->to('panel/asignacion');
        }
        $mozo  = User::find($asignacion->mozo);
        $asignacion['nombremozo'] = $mozo->nombre;
        $mesa = Mesas::find($asignacion->mesa);
        $asignacion['nombremesa'] = $mesa->nombre;
        $mesas = Mesas::all();
        $mozos = User::where('rol','mozo')->get();
        return view('paneladmin.asignacion.create',compact('mesas','mozos','asignacion'));

    }

    public function asignacionsave($id){
    //  dd($id);
      $datos = request()->all();
      $asignacion = MesaMozo::find($id);
      if($asignacion == null){
        Session::flash('mensaje','Esta asignacion no existe en el sistema');
      }else{
        $existe = MesaMozo::where('mozo',$datos['mozo'])->where('mesa',$datos['mesa'])->where('id','<>',$id)->get();
        if(count($existe) == 0){
          $mesayaasignada = MesaMozo::where('mesa',$datos['mesa'])->where('id','<>',$id)->get();
          if(count($mesayaasignada) == 0){
            $asignacion->fill($datos);
            $asignacion->save();
            Session::flash('mensaje','Esta asignacion actualizada con exito');
          }else{
            Session::flash('mensaje','Esta mesa ya esta asignada a otro mozo');
          }
        }else{
          Session::flash('mensaje','Esta asignacion no existe en el sistema');
        }
      }
      return redirect()->to('panel/asignacion');
    }

    public function indexcreate(){
      return view('paneladmin.mozos.create');
    }

    public function create(Request $request){

      $this->validate($request,[
        'nombre'=>['required'],
        'email'=>['required'],
        'password'=>['required'],
        'direccion'=>['required'],
        'telefono'=>['required'],
      ]);
      $datos = request()->all();
      $existe = $this->existemozo(null,$datos,"crear");
      if($existe->estado == true){
        Session::flash('message', $existe->mensaje);
        Session::flash('alert-class', 'alert-danger');
        return redirect()->to('panel/mozos/crear');
      }

      $datos['password'] = bcrypt($datos['password']);
      $datos['rol'] = 'mozo';
      User::create($datos);
      return redirect()->to('panel/mozos');
    }

    public function edit($id){
      $mozo = User::find($id);
      return view('paneladmin.mozos.create',compact('mozo'));
    }

    public function save($id){
      $datos = request()->all();
      $existe = $this->existemozo($id,$datos,'actualizar');
      if($existe->estado == true){
        Session::flash('message', $existe->mensaje);
        Session::flash('alert-class', 'alert-danger');
        return redirect()->to('panel/mozos/edit/'.$id);
      }

      $mozo = User::find($id);
      if($datos['password']==""){
        $datos['password'] = $mozo->password;
      }else{
        $datos['password'] = bcrypt($datos['password']);
      }

      $mozo->fill($datos);
      $mozo->save();
      return redirect()->to('panel/mozos');

    }

    public function delete($id){
      $mozo = User::find($id);
      $mozo->delete();
      return array('estado'=>true);
    }


    private function existemozo($id,$datos,$accion){

      if($accion == "actualizar"){
        $email = User::where('email',$datos['email'])->where('id','<>',$id)->count();
        $nombre = User::where('nombre',$datos['nombre'])->where('id','<>',$id)->count();
      }else{
        $email = User::where('email',$datos['email'])->count();
        $nombre = User::where('nombre',$datos['nombre'])->count();
      }

      if($email == 0 && $nombre == 0){
        $respuesta = (object)array(
          'mensaje'=>'',
          'estado' => false
        );
      }else{
        if($email != 0 && $nombre != 0){
          $respuesta = (object)array(
            'mensaje'=>' El Email y el Nombre, ya se encuentran en uso',
            'estado' => true
          );
        }else{
          if($email!=0){
            $respuesta = (object)array(
              'mensaje'=>' El Email,ya se encuentran en uso',
              'estado' => true
            );
          }
          if($nombre!=0){
            $respuesta = (object)array(
              'mensaje'=>' El Nombre,ya se encuentran en uso',
              'estado' => true
            );
          }

        }
      }
      return $respuesta;
    }

}
