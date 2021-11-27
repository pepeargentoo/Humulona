<?php

Route::get('imprimir','AdminController@imprimir');

Route::get('/','AdminController@index');
Route::post('/','AdminController@login');

Route::group(['middleware' => ['auth','admin']], function () {
  Route::get('panel','AdminController@general');
  Route::get('panel/mozos','MozoController@index');
  Route::get('panel/mozos/crear','MozoController@indexcreate');
  Route::post('panel/mozos/crear','MozoController@create');
  Route::get('panel/mozos/edit/{id}','MozoController@edit');
  Route::post('panel/mozos/edit/{id}','MozoController@save');
  Route::get('panel/mozos/delete/{id}','MozoController@delete');
  Route::get('panel/proveedores','ProveedoresController@index');
  Route::get('panel/proveedores/crear','ProveedoresController@indexcreate');
  Route::post('panel/proveedores/crear','ProveedoresController@create');
  Route::get('panel/proveedores/edit/{id}','ProveedoresController@edit');
  Route::post('panel/proveedores/edit/{id}','ProveedoresController@save');
  Route::get('panel/proveedores/delete/{id}','ProveedoresController@delete');
  Route::get('panel/clientes','ClienteController@index');
  Route::get('panel/clientes/crear','ClienteController@indexcreate');
  Route::post('panel/clientes/crear','ClienteController@create');
  Route::get('panel/clientes/edit/{id}','ClienteController@edit');
  Route::post('panel/clientes/edit/{id}','ClienteController@save');
  Route::get('panel/clientes/delete/{id}','ClienteController@delete');
  Route::get('panel/productos','ProductoController@index');
  Route::get('panel/productos/crear','ProductoController@indexcreate');
  Route::post('panel/productos/crear','ProductoController@create');
  Route::get('panel/productos/categorias','ProductoController@indexcategoria');
  Route::post('panel/productos/categorias','ProductoController@categoria');
  Route::get('panel/productos/categorias/edit/{id}','ProductoController@editcategoria');
  Route::post('panel/productos/categorias/edit/{id}','ProductoController@savecategoria');
  Route::get('panel/productos/categorias/delete/{id}','ProductoController@deletecategoria');
  Route::get('panel/productos/{id}','ProductoController@edit');
  Route::post('panel/productos/{id}','ProductoController@save');
  Route::get('panel/productos/delete/{id}','ProductoController@delete');
  Route::get('panel/mesas','MesaController@index');
  Route::get('panel/mesas/crear','MesaController@indexcreate');
  Route::post('panel/mesas/crear','MesaController@create');
  Route::get('panel/mesas/edit/{id}','MesaController@edit');
  Route::post('panel/mesas/edit/{id}','MesaController@save');
  Route::get('panel/mesas/delete/{id}','MesaController@delete');
  Route::get('panel/gestion','MesaController@panelgestion');
  Route::get('panel/estadomesas','MesaController@listadodemesas');
  Route::get('panel/salir','AdminController@salir');


  Route::get('panel/barra','BarraController@index');
  Route::post('panel/barra','BarraController@create');

  Route::get('panel/cocina','CocinaController@index');
  Route::post('panel/cocina','CocinaController@create');

  Route::get('panel/asignacion','MozoController@asignacionindex');
  Route::get('panel/asignacion/crear','MozoController@asignacionindexcreate');
  Route::post('panel/asignacion/crear','MozoController@asignacioncreate');
  Route::get('panel/asignacion/borrar/{id}','MozoController@asignaciondelete');
  Route::get('panel/asignacion/editar/{id}','MozoController@asignacionedit');
  Route::post('panel/asignacion/editar/{id}','MozoController@asignacionsave');
  Route::get('panel/gastos','GastosController@index');
  Route::get('panel/gastos/crear','GastosController@indexcreate');
  Route::post('panel/gastos/crear','GastosController@create');
  Route::get('panel/gastos/editar/{id}','GastosController@edit');
  Route::post('panel/gastos/editar/{id}','GastosController@save');
  Route::get('panel/gastos/borrar/{id}','GastosController@delete');

  Route::get('panel/compras','ComprasController@index');
  Route::get('panel/compras/crear','ComprasController@indexcreate');
  Route::get('panel/compras/productos/{id}','ComprasController@getproducto');
  Route::post('panel/compras/crear','ComprasController@create');

  Route::get('panel/compras/borrar/{id}','ComprasController@delete');
  Route::get('panel/compras/ver/{id}',   'ComprasController@viewed');
  Route::get('panel/stocks','StockController@index');
  Route::get('panel/precios','PreciosController@index');
  Route::get('panel/precios/edit/{id}','PreciosController@edit');
  Route::post('panel/precios/edit/{id}','PreciosController@save');
  Route::get('panel/finanzas','FinanzasController@index');
  Route::get('panel/finanzas/graficos','FinanzasController@graficos');
  Route::get('panel/finanzas/limites','FinanzasController@limite');
  Route::post('panel/finanzas/limites','FinanzasController@updatelimite');
  Route::get('panel/finanzas/facturacion','FinanzasController@facturacion');
  Route::get('panel/finanzas/facturacion/facturar','FinanzasController@facturaiva');
  Route::get('panel/finanzas/facturacion/{id}','FinanzasController@ivaafip');
  Route::get('panel/finanzas/graficos/gastos','FinanzasController@gastos');
  Route::get('/panel/finanzas/graficos/empleados','FinanzasController@empleados');

});

Route::group(['middleware' => ['auth','mozo']],function(){
  Route::get('panelmozo','MozoController@panelmozo');
  Route::get('panelmozo/salir','AdminController@salir');
  Route::get('panelmozo/mesas','PanelMozoController@mesas');
  Route::get('panelmozo/mesas/tomar/{id}','PanelMozoController@tomar');
  Route::post('panelmozo/mesas/tomar/{id}','PanelMozoController@registrar');
  Route::get('panelmozo/tomar/productos/{id}','PanelMozoController@getProductos');
  Route::get('panelmozo/mesa/ver/{id}','PanelMozoController@vermesa');
  Route::get('panelmozo/mozos/agregar/{id}','PanelMozoController@agregarproductos');
  Route::post('panelmozo/mozos/agregar/{id}','PanelMozoController@guardarproductos');
  Route::get('panelmozo/mozos/borrar/{id}/{id2}','PanelMozoController@delete');
  Route::get('panelmozo/mozos/mesa/cerrar/{id}','PanelMozoController@previsualizar');
  Route::get('panelmozo/mesas/cerrar/aprobacion/{id}','PanelMozoController@esperando');
});


Route::group(['middleware' => ['auth','barra']],function(){
  Route::get('panelbarra','BarraController@panelbarra');
  Route::get('panelbarra/mesas','BarraController@mesas');

  Route::get('panelbarra/cocina/{id}','BarraController@tiketcocina');
  Route::get('panelbarra/bebida/{id}','BarraController@tiketbebida');
  Route::get('panelbarra/mesa/ver/{id}','BarraController@vermesa');

  Route::get('panelbarra/cerrarcaja','BarraController@indexcaja');
  Route::get('panelbarra/cerrarcaja/cerrar','BarraController@cerrar');
  Route::get('panelbarra/cerrarcaja/cerrar/{id}','BarraController@vercierre');

  Route::get('panelbarra/salir','AdminController@salir');
  Route::get('panelbarra/cerrarmesa/{id}','BarraController@cerrarmesa');
  Route::get('panelbarra/cerrarmesaiva/{id}','BarraController@cerrarmesaiva');

  Route::get('panelbarra/tomar/productos/{id}','BarraController@getProductos');
});


  Route::get('/t','BarraController@factura');

  Route::get('panelcocina','CocinaController@panelcocina');
  Route::get('panelcocina/pedidos','CocinaController@getpedidos');
  Route::get('panelcocina/pedidos/{id}','CocinaController@pedido');
  Route::get('panelcocina/salir','AdminController@salir');
