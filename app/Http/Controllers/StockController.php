<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
class StockController extends Controller
{
    //
    public function index(){
      $productos = Producto::all();
      return view('paneladmin.stocks.index',compact('productos'));
    }
}
