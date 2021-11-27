<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
class PreciosController extends Controller
{
    //

    public function index(){
      $productos = Producto::all();
      return view('paneladmin.precios.index',compact('productos'));
    }

    public function edit($id){
      $producto = Producto::find($id);
      return view('paneladmin.precios.cambiar',compact('producto'));
    }

    public function save($id){
      $producto = Producto::find($id);
      $datos = request()->all();
      $producto->fill($datos);
      $producto->save();
      return redirect()->to('panel/precios');
    }
}
