<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Proveedor;
use App\Producto;
use App\Compra;
use Session;

//"barryvdh/laravel-dompdf" : "0.7.0"
class ComprasController extends Controller
{
    //
    public function index(){
      $compras = Compra::all();
      foreach ($compras as $c) {
        $proveedor = Proveedor::find($c->proveedores);
        if($proveedor == null){
          $c['proveedor'] = 'sin proveedor';
        }else{
          $c['proveedor'] = $proveedor->razonsocial;
        }
      }
      return view('paneladmin.compras.index',compact('compras'));
    }

    public function indexcreate(){
      $proveedores = Proveedor::all();
    return view('paneladmin.compras.create',compact('proveedores'));
    }

    public function getproducto($id){
      $productos = Producto::where('proveedor',$id)->get();
      return $productos;
    }

    public function create(){
      $datos = request()->all();
      $articulo = array(
        'productos'=>$datos['producto'],
        'cantidad'=>$datos['productocantidad']
      );
      foreach ($datos['producto'] as $key => $p) {
        $producto = Producto::find($p);
        $producto->unidadactuales = $producto->unidadactuales + $datos['productocantidad'][$key];
        $producto->save();
      }
      set_time_limit(300);

      $proveedor = Proveedor::find($datos['proveedores']);
      $datos['articulos'] = json_encode($articulo);
      $datos['descripcion'] = json_encode( array(
        'articulo'=>$datos['articulo'],
        'precio'=>$datos['precio'],
        'cantidad'=>$datos['cantidad']
      ));
      $datos['monto'] = $datos['total'];
      $compra = Compra::create($datos);
      $pdf['proveedor'] = $proveedor->razonsocial;
      $pdf['articulos'] = $datos['articulo'];
      $pdf['cantidad']= $datos['cantidad'];
      $pdf['precio'] = $datos['precio'];
      $pdf['total'] =$datos['total'];
      $pdf['fecha'] = date('d/m/Y');
      $pdf = \PDF::loadView('informes', compact('pdf'));
      $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
      $pdf->save('uploads/compra-'.$compra->id.'.pdf');
      Session::flash('mensaje','Fue creado con exito');
      return redirect()->to('/panel/compras');

    }

    public function delete($id){
      $compras = Compra::find($id);
      if($compras != null){
        $compras->delete();
      }
      return array('success'=>true);
    }


    public function viewed($id){
      header("Content-type:application/pdf");
      header("Content-Disposition:attachment;filename='InformedeCompras.pdf'");
      readfile("uploads/compra-".$id.'.pdf');
    }
}
