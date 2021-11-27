<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Mesas;
use App\Estadia;
use App\Categoria;
use App\MesaMozo;
use Session;
use Auth;
use Carbon\Carbon;
use App\EstadiaProducto;
use App\Producto;
use App\CierreCaja;
use App\CierreCajaProducto;
use Afip;

class BarraController extends Controller
{

    public function index(){
      $barra = User::where('rol','barra')->first();
      return view('paneladmin.barra.index',compact('barra'));
    }

    public function panelbarra(){
      return view('panelbarra.gestion');
    }

    public function cerrarmesa($id){
      $mesa = Mesas::find($id);
      $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->get();

      if(count($estadia) > 1){
        $idsborrar = [];
        for($i=0;$i< count($estadia)-1;$i++){
          $idsborrar[] = $estadia[$i]->id;
        }
        foreach ($idsborrar as $i) {
          $estadia = Estadia::find($i);
          $estadia->estado = 'finalizado';
          $estadia->save();
        }
        $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->first();

      }else{
        $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->first();
      }
    //  dd($estadia,EstadiaProducto::where('estadia',$estadia->id)->get());
      $productos = EstadiaProducto::where('estadia',$estadia->id)->get();
      $finproducto = array('producto'=>[],
                      'cantidad'=>[],
                      'precio'=>[]);

      foreach ($productos as $k=>$p) {

        $producto = Producto::where('nombre',$p->nombre)->first();

        if($producto != null){
          $finproducto['cantidad'][$k] = $p->cantida;
          $finproducto['producto'][$k] = $p->nombre;
          $finproducto['precio'][$k] = $producto->precioventa;
        }else{
          unset($productos[$k]);
        }


      }
      //dd($productos);
      //dd($finproducto);
      $total = $estadia->monto;
      $estadia->estado = 'finalizado';
      $estadia->facturado = false;
      $estadia->save();
      return view('cerrar',compact('finproducto','mesa','total'));
    }

    public function factura(){
      $CUIT = 20300028102; //HUMULONA
      $afip = new Afip(array('CUIT' => $CUIT));
      $ultimo = $afip->ElectronicBilling->GetLastVoucher(1,6);
      $ultimo++;
      $data = array(
        'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
        'PtoVta' 	=> 1,  // Punto de venta
        'CbteTipo' 	=> 6,  // Tipo de comprobante (Factura B)(ver tipos disponibles)
        'Concepto' 	=> 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
        'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
        'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
        'CbteDesde' 	=> $ultimo,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
        'CbteHasta' 	=> $ultimo,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
        'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
        'ImpTotal' 	=> 121, // Importe total del comprobante
        'ImpTotConc' 	=> 0,   // Importe neto no gravado
        'ImpNeto' 	=> 100, // Importe neto gravado
        'ImpOpEx' 	=> 0,   // Importe exento de IVA
        'ImpIVA' 	=> 21,  //Importe total de IVA
        'ImpTrib' 	=> 0,   //Importe total de tributos
        'FchServDesde' 	=> intval(date('Ymd')), // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
	      'FchServHasta' 	=> intval(date('Ymd')), // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
	      'FchVtoPago' 	=> intval(date('Ymd')),
        'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
        'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)
	       'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
		         array(
			            'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles)
			             'BaseImp' 	=> 100, // Base imponible
			             'Importe' 	=> 21 // Importe
		               )
	                ),
        );

        $res = $afip->ElectronicBilling->CreateVoucher($data);
        //dd($afip->ElectronicBilling->GetSalesPoints(),$afip->ElectronicBilling);
      dd($afip,$res);
    }
     public function getProductos($id){
      $productos = Producto::where('categoria',$id)
      ->where('precioventa','>',0)->where('unidadactuales','>',0)->get();
      return array('resp'=>'success','productos'=>$productos,'total'=>count($productos));
    }

    public function cerrarmesaiva($id){
      $mesa = Mesas::find($id);
       $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->get();
      if(count($estadia) > 1){
        $idsborrar = [];
        for($i=0;$i< count($estadia)-1;$i++){
          $idsborrar[] = $estadia[$i]->id;
        }
        foreach ($idsborrar as $i) {
          $estadia = Estadia::find($i);
          $estadia->estado = 'finalizado';
          $estadia->save();
        }
        $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->first();
      }else{
        $estadia = Estadia::where('mesa',$mesa->nombre)->where('estado','<>','finalizado')->first();
      }
      $productos = EstadiaProducto::where('estadia',$estadia->id)->get();
      $finproducto = array('producto'=>[],
                           'cantidad'=>[],
                           'precio'=>[]);
      foreach ($productos as $k=>$p) {
        $producto = Producto::where('nombre',$p->nombre)->first();
        $finproducto['cantidad'][$k] = $p->cantida;
        $finproducto['producto'][$k] = $p->nombre;
        $finproducto['precio'][$k] = $producto->precioventa;
      }
      $total = $estadia->monto;
      $estadia->estado = 'finalizado';
      $estadia->save();
      $estadia->facturado = true;
      $estadia->save();
      return view('iva',compact('finproducto','mesa','total'));
    }

    public function vercierre($id){
      $cierre = CierreCaja::find($id);
      $productos = CierreCajaProducto::where('cierre',$cierre->id)->get();
      return view('panelbarra.cerrarcajas.view',compact('cierre','productos'));
    }

    public function create(){
      $datos = request()->all();
      $existe = User::where('rol','barra')->first();
      $datos['password'] = bcrypt($datos['password']);
      $datos['rol'] = 'barra';
      if($existe == null){
        User::create($datos);
      }else{
        if($datos['password'] == ""){
          $datos['password'] = $existe->password;
        }

        if($datos['email'] == ""){
          $datos['email'] = $existe->email;
        }

        if($datos['nombre'] == ""){
          $datos['nombre'] = $existe->email;
        }

        $existe->fill($datos);
        $existe->save();
      }
      Session::flash('mensaje','Los datos fueron actualizado con exito');
      return redirect()->to('panel');
    }

    public function mesas(){
      $mesas = Mesas::all();
      foreach ($mesas as $m) {
        $estadia = Estadia::where('mesa',$m->nombre)->where('estado','<>','finalizado')->get();
        if(count($estadia)>0){
          $m['ocupada'] = 'si';
          $m['estadia'] = $estadia;
        }else{
          $m['ocupada'] = 'no';
        }
      }
      return view('panelbarra.mesas.index',compact('mesas'));
    }

    public function tiketcocina($id){
      $estadia = Estadia::find($id);
      $hora = $estadia->created_at->format('h:m');
      $cocina = json_decode($estadia['ticketcomida']);
      $mesa = $estadia->mesa;
      $estadia->comida = false;
      $estadia->save();
      return view('cocina',compact('cocina','mesa','hora'));
    }

    public function tiketbebida($id){
      $estadia = Estadia::find($id);
      $cocina = json_decode($estadia['ticketbebida']);
      $mesa = $estadia->mesa;
      $estadia->bebida = false;
      $estadia->save();
      return view('birra',compact('cocina','mesa'));
     }

    public function vermesa($id){
      $mesamozo = Mesas::find($id);
      $date = Carbon::now();
      $estadia = Estadia::where('mesa',$mesamozo->nombre)->where('estado','<>','finalizado')->get();
      if(count($estadia) > 1){
        $idsborrar = [];
        for($i=0;$i< count($estadia)-1;$i++){
          $idsborrar[] = $estadia[$i]->id;
        }
        foreach ($idsborrar as $i) {
          $estadia = Estadia::find($i);
          $estadia->estado = 'finalizado';
          $estadia->save();
        }
        $estadia = Estadia::where('mesa',$mesamozo->nombre)->where('estado','<>','finalizado')->first();
      }else{
        $estadia = Estadia::where('mesa',$mesamozo->nombre)->where('estado','<>','finalizado')->first();
      }

      $estadiaedit= $estadia;

      if($estadiaedit == null){
        $mozo = '';
      }else{
        if($estadiaedit->mozo == ""){
          $mozo = '';
        }else{
          $mozo = User::find($estadiaedit->mozo);
          $mozo = $mozo->nombre;
        }
      }
      $estadiaedit['nombremozo'] = $mozo;
      if($estadiaedit != null){
        $estadiaproducto = EstadiaProducto::where('estadia',$estadiaedit->id)->get();
        $estadiaedit['productos'] = $estadiaproducto;
        $mesaedit = Mesas::where('nombre',$estadiaedit->mesa)->first();
        $estadiaedit['idmesa'] = $mesaedit->id;
        $productos = Producto::all();
        $mesasibres = Mesas::all();
        foreach ($mesasibres as $key => $m) {
          $estadia = Estadia::where('mesa',$m->nombre)->where('estado','proceso')->count();
          if($estadia != 0){
            unset($mesasibres[$key]);
          }
        }
      }else{
        return redirect()->to('panelbarra');
      }
    //  dd($estadiaedit);
      return view('panelbarra.mesa.ver',compact('estadiaedit','id'));
    }

    public function borrarproductomes($producto,$mesa){
      //dd($producto,$mesa);
      //dd($producto);
      $prod = EstadiaProducto::find($producto);
      $monto = $prod->monto;
      $prod->delete();
      $estadia = Estadia::find($prod->estadia);
      $estadia->monto = $estadia->monto - $monto;
      $estadia->save();
      //dd($prod,$estadia);
      return redirect()->to('panelbarra/mesa/ver/'.$mesa);
    }
    public function indexcaja(){
      $cierres = CierreCaja::all();
      return view('panelbarra.cerrarcajas.index',compact('cierres'));
    }

    public function cerrar(){
      $total = 0;
      $estadias = Estadia::where('estado','finalizado')->where('fecha',date('Y-m-d'))->get();
      foreach ($estadias as $es) {
        $total += $es->monto;
      }
      $cierre=CierreCaja::create(array(
        'fecha'=>date('d/m/Y'),
        'monto'=>$total
      ));
      foreach ($estadias as $es) {
         CierreCajaProducto::create(array(
          'mesa'=>$es->mesa,
          'precio'=>$es->monto,
          'cierre'=>$cierre->id
        ));
      }
      return view('cierredecaja',compact('total','estadias'));
    }

    public function venta(){
      $categorias = Categoria::all();
      $mesas = Mesas::all();
      return view('panelbarra.ventas.index',compact('categorias','mesas'));
    }


    public function registrar(){
      $datos = request()->all();
       date_default_timezone_set('America/Argentina/Cordoba');
      $mesa = Mesas::find($datos['mesa']);
      $cocina = array('producto'=>[],
                      'cantidad'=>[],
                      'descripcion'=>[]
                    );
      $bebida = array('producto'=>[],
                      'cantidad'=>[]);
      foreach ($datos['listaproductos'] as $k => $value) {
        $producto = Producto::find($value);
        if($producto->unidadactuales < $datos['listacantidades'][$k] ){
          Session::flash('mensaje','No Hay unidades sufientes para la ventas de '.$producto->nombre);
          return redirect()->to('panelbarra/mesas');
        }
        $producto->unidadactuales = $producto->unidadactuales - (int)$datos['listacantidades'][$k];
        $producto->save();
        $categoria = Categoria::find($producto->categoria);
        if($categoria->cocina == "si"){
          $cocina['producto'][] = $producto->nombre;
          $cocina['cantidad'][] = $datos['listacantidades'][$k];
          $cocina['descripcion'][] = $datos['listadescripcion'][$k];
        }else{
          $bebida['producto'][] = $producto->nombre;
          $bebida['cantidad'][] = $datos['listacantidades'][$k];
        }
      }
      $date = Carbon::now();
      date_default_timezone_set('America/Argentina/Cordoba');
      $estadia = Estadia::create(array(
        "mesa"=> $mesa->nombre,
        'fecha'=> $date->format('Y-m-d'),
        'monto' =>$datos['total'],
        'estado'=>'ocupada',
        'ticketcomida'=>json_encode($cocina),
        'ticketbebida'=> json_encode($bebida),
        'bebida'=>(count($bebida['producto'])>0)?true:false,
        'comida'=>(count($cocina['producto'])>0)?true:false,
        'cocina'=>(count($cocina['cantidad'])>0)?'pendiente':'norequerido'
      ));

      foreach ($datos['listaproductos'] as $k=>$p) {
        $producto = Producto::find($p);
        $es = EstadiaProducto::create(array(
          'estadia'=>$estadia->id,
          'cantida'=>(int)$datos['listacantidades'][$k],
          'nombre'=>$producto->nombre,
          'monto'=>$datos['listacantidades'][$k]*$producto->precioventa
        ));
      }
      return redirect()->to('panelbarra');
    }
}
