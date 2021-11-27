<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
class AdminController extends Controller
{

    public function imprimir(){
      return view('tiket');
      $pdf = \PDF::loadView('tiket');
      $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
      return $pdf->stream();
    }

    public function index(){
      return view('login');
    }

    public function login(Request $request){
      $this->validate($request,[
        '_token'=>['required'],
        'email'=>['required'],
        'password'=>['required']
      ]);

      $datos = request()->all();
      unset($datos['_token']);

      if(Auth::attempt($datos)){
        if(Auth::user()->rol == "admin"){
          return redirect()->to('panel');
        }
        if(Auth::user()->rol == "mozo"){
          return redirect()->to('panelmozo');
        }

        if(Auth::user()->rol == "barra"){
          return redirect()->to('panelbarra');
        }

        if(Auth::user()->rol == "cocina"){
          return redirect()->to('panelcocina');
        }


      }
      return redirect()->to('/');
    }

    public function salir(){
       Auth::logout();
       Session::flush();
       return redirect()->to('/');
    }

    public function general(){
      return view('paneladmin.index');
    }
}
