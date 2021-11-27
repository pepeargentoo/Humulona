<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Producto;
use App\Proveedor;
use App\Categoria;

class ProductoController extends Controller
{
    public function index(){
      $productos = Producto::all();
      foreach ($productos as $p) {
        // code...
        $categoria = Categoria::find($p->categoria);
        $proveedor = Proveedor::find($p->proveedor);
        $p['categoria'] = $categoria->nombre;
        $p['proveedor'] = $proveedor->razonsocial;

        //dd($p);
      }
      return view('paneladmin.productos.index',compact('productos'));
    }

    public function indexcreate(){
      $proveedores = Proveedor::all();
      $categorias = Categoria::all();
      return view('paneladmin.productos.create',compact('proveedores','categorias'));
    }

    public function create(Request $request){
      //dd(request()->all());

          $datos = request()->all();
          //dd($datos);
          Producto::create($datos);
          return redirect()->to('panel/productos');

    }


    public function edit($id){
      $producto = Producto::find($id);
      $proveedores = Proveedor::all();
      $categorias = Categoria::all();
      $categoria = Categoria::find($producto->categoria);
      //dd($categorias);
      //dd($producto,$producto['proveedor']);
      $proveedor = Proveedor::find($producto['proveedor']);
      $producto['nombrecategoria'] = $categoria->nombre;
      $producto['nombreproveedor'] = $proveedor->nombre;
    //  dd($producto);
      return view('paneladmin.productos.create',compact('proveedores','categorias','producto'));
    }

    public function save($id){
      $datos = request()->all();
      $producto = Producto::find($id);
      $producto->fill($datos);
      $producto->save();
      return redirect()->to('panel/productos');
    }

    public function indexcategoria(){
      $categorias = Categoria::all();
      return view('paneladmin.productos.categoria',compact('categorias'));
    }

    public function delete($id){
      $producto = Producto::find($id);
      $producto->delete();
      return redirect()->to('panel/productos');
    }

    public function categoria(){
      $datos = request()->all();
      $categoria = Categoria::create($datos);
      return redirect()->to('panel/productos/categorias');
    }

    public function editcategoria($id){
      $categoria = Categoria::find($id);
      $categorias = Categoria::all();
      return view('paneladmin.productos.categoria',compact('categoria','categorias'));
    }

    public function savecategoria($id){

      $datos = request()->all();
      $existe = $this->validatecategoria($id,$datos,"actualizar");

      if($existe->estado == false){
          $categoria = Categoria::find($id);
          $categoria->fill($datos);
          $categoria->save();
          return redirect()->to('panel/productos/categorias');
      }
      Session::flash('message', $existe->mensaje);
      Session::flash('alert-class', 'alert-danger');
      return redirect()->to('panel/productos/categorias');
    }

    public function deletecategoria($id){
      $categoria = Categoria::find($id);
      $productos = Producto::where('categoria',$id)->delete();
      $categoria->delete();
      return redirect()->to('panel/productos/categorias');

    }

    private function validatecategoria($id,$datos,$accion){
      if($accion == "crear"){
        $nombre = Categoria::where('nombre',$datos['nombre'])->count();
      }else{
        $nombre = Categoria::where('nombre',$datos['nombre'])->where('id','<>',$id)->count();
      }

      if($nombre == 0){
      $respuesta = (object)array(
        'estado'=>false,
        'mensaje'=>''
      );
    }else{
      $respuesta = (object)array(
        'estado'=>true,
        'mensaje'=>'Esta Categoria ya existe.'
      );
    }
     return $respuesta;

    }

    private function validateproducto($id,$datos,$accion){
      if($accion == "crear"){
        $nombre = Producto::where('nombre',$datos['nombre'])->count();
      }



    }

}
