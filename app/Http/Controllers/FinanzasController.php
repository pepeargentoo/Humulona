<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CierreCaja;
use App\Compra;
use App\LimiteFactura;
use App\Gastos;
use App\Estadia;
use Afip;

class FinanzasController extends Controller
{
    //
    public function index(){
    	return view('paneladmin.finanzas.gestion');
    }

    public function graficos(){
    	$compras = Compra::sum('monto');
    	$gastos = Gastos::where('tipo','gastos')->sum('monto');
      $empleados = Gastos::where('tipo','<>','gastos')->sum('monto');
      $ganancias = CierreCaja::sum('monto');
      $cierrescaja = CierreCaja::all();
      $cajas = [];
      foreach ($cierrescaja as $c) {
        $cajas[$c['fecha']] = $c['monto'];
      }
      return view('paneladmin.finanzas.graficos',compact('ganancias','compras','gastos','empleados','cajas'));
    }

    public function gastos(){
      $gastos = Gastos::where('tipo','gastos')->orderBy('id','desc')->get();
      return view('paneladmin.finanzas.gastos',compact('gastos'));
    }

    public function empleados(){
      $empleados = Gastos::where('tipo','<>','gastos')->orderBy('id','desc')->get();
      return view('paneladmin.finanzas.empleados',compact('empleados'));
    }

    public function cierredecaja(){
      $cierredecaja = CierreCaja::all();
      return view('paneladmin.finanzas.cierredecajas',compact('cierredecaja'));
    }

    public function limite(){
    	$limite = LimiteFactura::whereMonth('created_at', date('m'))->first();
    	if($limite==null){
    		$limite = LimiteFactura::create(array(
    			'limite' => 0,
        		'actual'=> 0
    		));
    	}
    	return view('paneladmin.finanzas.limite',compact('limite'));
    }
    public function updatelimite(){
    	$datos = request()->all();
    	$limite = LimiteFactura::find($datos['id']);
    	$limite->fill($datos);
    	$limite->save();
    	return redirect()->to('panel/finanzas');
    }


    public function facturacion(){
    	$facturas = Estadia::where('estado','finalizado')->where('facturado',true)->get();
    	$total = Estadia::where('estado','finalizado')->where('facturado',true)->sum('monto');
      $limite = LimiteFactura::find(LimiteFactura::count());
    	return view('paneladmin.finanzas.index',compact('total','facturas','limite'));
    }

    public function ivaafip($id){

      $factura = Estadia::find($id);
      $total = $factura->monto;
      $cantidadfacturas =$total / 6500;
      if($total % 6500 != 0){
        $cantidadfacturas = (int)$cantidadfacturas;
        $cantidadfacturas += 1;
        $ultima = ($cantidadfacturas*6500) - $total;
      }

      for($i=0;$i<$cantidadfacturas;$i++){
        $CUIT = 30716844532; //HUMULONA
        $afip = new Afip(array('CUIT' => $CUIT, 'production' => true));
      //  $afip->options
        //$afip->options['production'] = true;
        //dd($afip->options);
        $nrofactura = $afip->ElectronicBilling->GetLastVoucher(2,6);
      //dd($nrofactura);
        $nrofactura++;
        if($i == ($cantidadfacturas -1)){
          $neto = round($ultima / 1.21, 2);
          $iva =  round($neto * 0.21, 2);
          $data = array(
            'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
            'PtoVta' 	=> 2,  // Punto de venta
            'CbteTipo' 	=> 6,  // Tipo de comprobante (Factura B)(ver tipos disponibles)
            'Concepto' 	=> 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
            'CbteDesde' 	=> $nrofactura,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> $nrofactura,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 	=> $ultima, // Importe total del comprobante
            'ImpTotConc' 	=> 0,   // Importe neto no gravado
            'ImpNeto' 	=> $neto, // Importe neto gravado
            'ImpOpEx' 	=> 0,   // Importe exento de IVA
            'ImpIVA' 	=> $iva,  //Importe total de IVA
            'ImpTrib' 	=> 0,   //Importe total de tributos
            'FchServDesde' 	=> intval(date('Ymd')), // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> intval(date('Ymd')), // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> intval(date('Ymd')),
            'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
            'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)
             'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
                 array(
                      'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles)
                       'BaseImp' 	=> $neto, // Base imponible
                       'Importe' 	=> $iva // Importe
                       )
                      ),
            );
        }else{
          $neto = round(6500 / 1.21, 2);
          $iva =  round($neto * 0.21, 2);
          $data = array(
            'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
            'PtoVta' 	=> 2,  // Punto de venta
            'CbteTipo' 	=> 6,  // Tipo de comprobante (Factura B)(ver tipos disponibles)
            'Concepto' 	=> 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
            'CbteDesde' 	=> $nrofactura,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> $nrofactura,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 	=> 6500, // Importe total del comprobante
            'ImpTotConc' 	=> 0,   // Importe neto no gravado
            'ImpNeto' 	=> $neto, // Importe neto gravado
            'ImpOpEx' 	=> 0,   // Importe exento de IVA
            'ImpIVA' 	=> $iva,  //Importe total de IVA
            'ImpTrib' 	=> 0,   //Importe total de tributos
            'FchServDesde' 	=> intval(date('Ymd')), // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> intval(date('Ymd')), // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> intval(date('Ymd')),
            'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
            'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)
            'Iva' => array( // (Opcional) Alícuotas asociadas al comprobante
                 array(
                      'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles)
                       'BaseImp' 	=> $neto, // Base imponible
                       'Importe' 	=> $iva // Importe
                       )
                      ),
            );
        }
        $res = $afip->ElectronicBilling->CreateVoucher($data);
        //dd($res);
      }
      $limite = LimiteFactura::find(LimiteFactura::count());
      $limite->actual = $total;
      $limite->save();
      $factura->facturado = false;
      $factura->save();
      return redirect()->to('panel/finanzas/facturacion');
      //actual
    }

    public function facturaiva(){
    	$total = Estadia::where('estado','finalizado')->where('facturado',true)->sum('monto');
      $facturas = Estadia::where('estado','finalizado')->where('facturado',true)->get();
    	$cantidadfacturas =$total / 6500;
      if($total % 6500 != 0){
        $cantidadfacturas = (int)$cantidadfacturas;
        $cantidadfacturas += 1;
        $ultima = ($cantidadfacturas*6500) - $total;
      }
    //  dd($total,$cantidadfacturas*6500,$ultima);

      dd('cac');

      for($i=0;$i<$cantidadfacturas;$i++){
        $CUIT = 20300028102; //HUMULONA
        $afip = new Afip(array('CUIT' => $CUIT));
        dd($afip);
        $nrofactura = $afip->ElectronicBilling->GetLastVoucher(2,6);
        $nrofactura++;
        if($i == ($cantidadfacturas -1)){
          $neto = round($ultima / 1.21, 2);
          $iva =  round($neto * 0.21, 2);
          $data = array(
            'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
            'PtoVta' 	=> 1,  // Punto de venta
            'CbteTipo' 	=> 6,  // Tipo de comprobante (Factura B)(ver tipos disponibles)
            'Concepto' 	=> 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
            'CbteDesde' 	=> $nrofactura,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> $nrofactura,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 	=> $ultima, // Importe total del comprobante
            'ImpTotConc' 	=> 0,   // Importe neto no gravado
            'ImpNeto' 	=> $neto, // Importe neto gravado
            'ImpOpEx' 	=> 0,   // Importe exento de IVA
            'ImpIVA' 	=> $iva,  //Importe total de IVA
            'ImpTrib' 	=> 0,   //Importe total de tributos
            'FchServDesde' 	=> intval(date('Ymd')), // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> intval(date('Ymd')), // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> intval(date('Ymd')),
            'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
            'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)
             'Iva' 		=> array( // (Opcional) Alícuotas asociadas al comprobante
                 array(
                      'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles)
                       'BaseImp' 	=> $neto, // Base imponible
                       'Importe' 	=> $iva // Importe
                       )
                      ),
            );
        }else{
          $neto = round(6500 / 1.21, 2);
          $iva =  round($neto * 0.21, 2);
          $data = array(
            'CantReg' 	=> 1,  // Cantidad de comprobantes a registrar
            'PtoVta' 	=> 1,  // Punto de venta
            'CbteTipo' 	=> 6,  // Tipo de comprobante (Factura B)(ver tipos disponibles)
            'Concepto' 	=> 2,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 	=> 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
            'DocNro' 	=> 0,  // Número de documento del comprador (0 consumidor final)
            'CbteDesde' 	=> $nrofactura,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 	=> $nrofactura,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
            'CbteFch' 	=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 	=> 6500, // Importe total del comprobante
            'ImpTotConc' 	=> 0,   // Importe neto no gravado
            'ImpNeto' 	=> $neto, // Importe neto gravado
            'ImpOpEx' 	=> 0,   // Importe exento de IVA
            'ImpIVA' 	=> $iva,  //Importe total de IVA
            'ImpTrib' 	=> 0,   //Importe total de tributos
            'FchServDesde' 	=> intval(date('Ymd')), // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> intval(date('Ymd')), // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> intval(date('Ymd')),
            'MonId' 	=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
            'MonCotiz' 	=> 1,     // Cotización de la moneda usada (1 para pesos argentinos)
            'Iva' => array( // (Opcional) Alícuotas asociadas al comprobante
                 array(
                      'Id' 		=> 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles)
                       'BaseImp' 	=> $neto, // Base imponible
                       'Importe' 	=> $iva // Importe
                       )
                      ),
            );
        }

      //  dd($data);
        $res = $afip->ElectronicBilling->CreateVoucher($data);
      }

      foreach ($facturas as $f) {
        dd($f);
        // code...
      }
      /*



      $ultimo++;




      */

      //$estadias = Estadia::where('estado','finalizado')->where('facturado',true)->get();
      dd($cantidadfacturas,$total);
        return redirect()->to('panel/finanzas');
    	dd('facturar con iva',$cantidadfacturas);
    }


}
