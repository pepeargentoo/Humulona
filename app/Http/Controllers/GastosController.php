<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Gastos;
use Session;
class GastosController extends Controller
{
    //
    public function index(){
      $gastos = Gastos::all();
      return view('paneladmin.gastos.index',compact('gastos'));
    }

    public function indexcreate(){
      return view('paneladmin.gastos.create');
    }

    public function create(){
      $datos = request()->all();
      Session::flash('mensaje','El gasto fue creado con exito');
      Gastos::create($datos);
      return redirect()->to('panel/gastos');
    }

    public function edit($id){
      $gastos = Gastos::find($id);
      if($gastos == null){
        Session::flash('mensaje','El gasto no exite');
      }
      return view('paneladmin.gastos.create',compact('gastos'));
    }

    public function delete($id){
      $g = Gastos::find($id);
      if($g != null)
        $g->delete();
      Session::flash('mensaje','El gasto fue eliminado con exito');
      return array('succes'=>true);
    }

    public function save($id){
      $datos = request()->all();
      $g = Gastos::find($id);
      if($g == null){
        Session::flash('mensaje','El Gasto, no exite');
        return redirect()->to('panel/gastos');
      }
      $g->fill($datos);
      $g->save();
      Session::flash('mensaje','El Gasto,fue actualizado con exito');
      return redirect()->to('panel/gastos');
    }
}
