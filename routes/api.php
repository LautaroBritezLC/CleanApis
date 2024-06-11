<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//TODO--------------------------------------LOGIN, TOKENS , MENUES--------------------------------------------

use App\Http\Controllers\Api\login\usuarioController;

use App\Http\Controllers\Api\menu\menuController;


//CAMBIOOOOOOOOOOOOOOOOOOOOOOOOOO


//TODO--------------------------------------MODULO DE SEGURIDAD------------------------------------------------------

use App\Http\Controllers\Api\Seguridad\tiporolController;

use App\Http\Controllers\Api\Seguridad\rolModuloController;

use App\Http\Controllers\Api\Seguridad\sistemaApiController;

use App\Http\Controllers\Api\Seguridad\UsuariosController;

//TODO--------------------------------------MODULO DE PARAMETRIA------------------------------------------------------

use App\Http\Controllers\Api\Parametria\tipoPersonaController;

use App\Http\Controllers\Api\Parametria\TipoDocumentacionController;

use App\Http\Controllers\Api\Parametria\TipoMedidaController;

use App\Http\Controllers\Api\Parametria\TipoDomicilioController;

use App\Http\Controllers\Api\Parametria\TipoFacturaController;

use App\Http\Controllers\Api\Parametria\TipoDestinatarioFacturaController;

use App\Http\Controllers\Api\Parametria\TipoPermisoController;

use App\Http\Controllers\Api\Parametria\TipoPermisoDetalleController;

use App\Http\Controllers\Api\Parametria\TipoPersonaSistemaController;

use App\Http\Controllers\Api\Parametria\TipoProductoController;

use App\Http\Controllers\Api\Parametria\TipoCategoriaController;

use App\Http\Controllers\Api\Parametria\TipoImpuestoController;

use App\Http\Controllers\Api\Parametria\TipoFormaDePagoController;

use App\Http\Controllers\Api\Parametria\SucursalController;

use App\Http\Controllers\Api\Parametria\TipoModuloController;

//TODO--------------------------------------MODULO DE RECURSOS--------------------------------------------

use App\Http\Controllers\Api\Recursos\StockController;

use App\Http\Controllers\Api\Recursos\PersonalController;

use App\Http\Controllers\Api\Recursos\ClienteController;

use App\Http\Controllers\Api\Recursos\ProveedorController;


//TODO--------------------------------------LISTAS--------------------------------------------

use App\Http\Controllers\Api\Listas\ListaPersonasController;

use App\Http\Controllers\Api\Listas\ListaLocalidadesController;

use App\Http\Controllers\Api\Listas\ListaProvinciasController;

//TODO--------------------------------------HOME--------------------------------------------
use App\Http\Controllers\Api\Home\Graficos;


//TODO--------------------------------------LOGIN, TOKENS , MENUES--------------------------------------------

//LOGIN Y TOKENS
Route::post('/usuario',[usuarioController::class, 'spValidarUsuario']);

//obtener usuario desde el token
Route::get('/fnObtenerUsuDesdeBearer',[usuarioController::class, 'fnObtenerUsuDesdeBearer']);

//menues
Route::get('utils/menu',[menuController::class, 'SP_GetMenu']);
//submenues
Route::get('utils/menu/submenu',[menuController::class, 'SP_GetSubMenu']);

//ImagenSubMenu
Route::get('utils/submenu/image',[menuController::class, 'SP_GetImagenSubMenu']);


//listar Usuarios
Route::get('seguridad/usuarios',[UsuariosController::class, 'SPL_Usuarios']);

//listar tipo rol
Route::get('seguridad/tiporoles',[tiporolController::class, 'SPL_TipoRol']);


//listar rol modulo
Route::get('seguridad/rolmodulos',[rolModuloController::class, 'SPL_RolModulo']);



      //-------------------------SUBMODULO DE TipoPersona-------------------------
      //listar tipo persona
      Route::get('parametria/tipopersona',[tipoPersonaController::class, 'SPL_TipoPersona']);

      //-------------------------SUBMODULO DE TipoDocumentacion-------------------------
      //listar tipo Documentacion
      Route::get('parametria/tipodocumentacion',[TipoDocumentacionController::class, 'SPL_TipoDocumentacion']);

      //-------------------------SUBMODULO DE TipoMedida-------------------------
      //listar tipo Medida
      Route::get('parametria/tipomedida',[TipoMedidaController::class, 'SPL_TipoMedida']);

      //-------------------------SUBMODULO DE TipoDomicilio-------------------------
      //listar tipo Domicilio
      Route::get('parametria/tipodomicilio',[TipoDomicilioController::class, 'SPL_TipoDomicilio']);

      //-------------------------SUBMODULO DE TipoFactura-------------------------
      //listar tipo Factura
      Route::get('parametria/tipofactura',[TipoFacturaController::class, 'SPL_TipoFactura']);

      //-------------------------SUBMODULO DE TipoDestinatarioFactura-------------------------
      //listar tipo DestinatarioFactura
      Route::get('parametria/tipodestinatariofactura',[TipoDestinatarioFacturaController::class, 'SPL_TipoDestinatarioFactura']);

      //-------------------------SUBMODULO DE TipoTipoPermiso-------------------------
      //listar tipo Permiso
      Route::get('parametria/tipopermiso',[TipoPermisoController::class, 'SPL_TipoPermiso']);

      //-------------------------SUBMODULO DE TipoPermisoDetalle-------------------------
      //listar tipo PermisoDetalle
      Route::get('parametria/tipopermisodetalle',[TipoPermisoDetalleController::class, 'SPL_TipoPermisoDetalle']);

      //-------------------------SUBMODULO DE TipoPersonaSistema-------------------------
      //listar tipo PersonaSistema
      Route::get('parametria/tipopersonasistema',[TipoPersonaSistemaController::class, 'SPL_TipoPersonaSistema']);

      //-------------------------SUBMODULO DE TipoProducto-------------------------
      //listar Tipo Producto
      Route::get('parametria/tipoproducto',[TipoProductoController::class, 'SPL_TipoProducto']);

      //listar Tipo Categoria
      Route::get('parametria/tipocategoria',[TipoCategoriaController::class, 'SPL_TipoCategoria']);

      //listar Tipo Impuesto
      Route::get('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPL_TipoImpuesto']);

      //listar Tipo FormaDePago
      Route::get('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPL_TipoFormaDePago']);

      //listar Tipo Sucursal
      Route::get('parametria/sucursales',[SucursalController::class, 'SPL_Sucursal']);

      //listar Producto
      Route::get('gestion/inventario',[StockController::class, 'SPL_Producto']);

      //listar TipoModulo
      Route::get('parametria/tipomodulo',[TipoModuloController::class, 'SPL_TipoModulo']);
      //lista persona extra
      Route::get('lista/personas',[ListaPersonasController::class, 'SP_ListaPersonas']);

      //lista localidades extra
      Route::get('lista/localidad',[ListaLocalidadesController::class, 'SPL_Localidad']);

      //lista provincias extra
      Route::get('lista/provincia',[ListaProvinciasController::class, 'SPL_Provincia']);

      //listar Personal
      Route::get('recursos/personal',[PersonalController::class, 'SPL_Personal']);

      //listar Cliente
      Route::get('recursos/clientes',[ClienteController::class, 'SPL_Cliente']);

      //listar Proveedor
      Route::get('recursos/proveedores',[ProveedorController::class, 'SPL_Proveedor']);

      //listar usuarios por rol
      Route::get('seguridad/usuarios/rol',[UsuariosController::class, 'SP_ListaUsuariosRol']);


Route::middleware('validarbearer')->group(function () {

      //--------------------------------------MODULO DE SEGURIDAD------------------------------------------------------

      //-------------------------SUBMODULO DE Usuarios-------------------------


      //agregar Usuarios
      Route::post('seguridad/usuarios',[UsuariosController::class, 'SPA_Usuarios']);

      //editar Usuarios
      Route::put('seguridad/usuarios',[UsuariosController::class, 'SPM_Usuarios']);

      //borrar Usuarios
      Route::delete('seguridad/usuarios',[UsuariosController::class, 'SPB_Usuarios']);

      //agregar rol usuario
      Route::post('seguridad/usuarios/rol',[UsuariosController::class, 'SPA_AgregarRolUsuario']);

      // borrar usuario rol
      Route::delete('seguridad/usuarios/rol',[UsuariosController::class, 'SPB_UsuarioRol']);

      //editar usuario por sucursal
      Route::put('seguridad/usuarios/sucursal',[UsuariosController::class, 'SPM_UsuarioPorSucursal']);


      //-------------------------SUBMODULO DE TipoRol-------------------------

      //agregar tipo rol
      Route::post('seguridad/tiporoles',[tiporolController::class, 'SPA_TipoRol']);

      //modificar tipo rol
      Route::put('seguridad/tiporoles',[tiporolController::class, 'SPM_TipoRol']);

      //borrar tipo rol
      Route::delete('seguridad/tiporoles',[tiporolController::class, 'SPB_TipoRol']);

      //habilitar tipo rol
      Route::put('seguridad/tiporoles/habilitar',[tiporolController::class, 'SPH_TipoRol']);


      //-------------------------SUBMODULO DE RolModulo-------------------------

      //agregar rol modulo
      Route::post('seguridad/rolmodulos',[rolModuloController::class, 'SPA_RolModulo']);

      //borrar rol modulo
      Route::delete('seguridad/rolmodulos',[rolModuloController::class, 'SPB_RolModulo']);

      //habilitar rol modulo
      Route::put('seguridad/rolmodulos',[rolModuloController::class, 'SPH_RolModulo']);


      //-------------------------SUBMODULO DE SistemaAPIs-------------------------

      //sistema apis
      Route::get('/SP_SistemaAPIs',[sistemaApiController::class, 'SP_SistemaAPIs']);


      //TODO--------------------------------------MODULO DE PARAMETRIA------------------------------------------------------



      //agregar Tipo Producto
      Route::post('parametria/tipoproducto',[TipoProductoController::class, 'SPA_TipoProducto']);

      //editar Tipo Producto
      Route::put('parametria/tipoproducto',[TipoProductoController::class, 'SPM_TipoProducto']);

      //borrar Tipo Producto
      Route::delete('parametria/tipoproducto',[TipoProductoController::class, 'SPB_TipoProducto']);

      //habilitar Tipo Categoria
      Route::put('parametria/tipoproducto/habilitar',[TipoFormaDePagoController::class, 'SPH_TipoProducto']);

      //-------------------------SUBMODULO DE TipoCategoria-------------------------


      Route::post('parametria/tipocategoria',[TipoCategoriaController::class, 'SPA_TipoCategoria']);

      //editar Tipo Categoria
      Route::put('parametria/tipocategoria',[TipoCategoriaController::class, 'SPM_TipoCategoria']);

      //borrar Tipo Categoria
      Route::delete('parametria/tipocategoria',[TipoCategoriaController::class, 'SPB_TipoCategoria']);

      //habilitar Tipo Categoria
      Route::put('parametria/tipocategoria/habilitar',[TipoFormaDePagoController::class, 'SPH_TipoCategoria']);

      //-------------------------SUBMODULO DE TipoImpuesto-------------------------


      //agregar Tipo Impuesto
      Route::post('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPA_TipoImpuesto']);

      //editar Tipo Impuesto
      Route::put('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPM_TipoImpuesto']);

      //borrar Tipo Impuesto
      Route::delete('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPB_TipoImpuesto']);

      //habilitar Tipo Impuesto
      Route::put('parametria/tipoimpuesto/habilitar',[TipoFormaDePagoController::class, 'SPH_TipoImpuesto']);

      //-------------------------SUBMODULO DE FormaDePago-------------------------


      //agregar Tipo FormaDePago
      Route::post('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPA_TipoFormaDePago']);

      //editar Tipo FormaDePago
      Route::put('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPM_TipoFormaDePago']);

      //borrar Tipo FormaDePago
      Route::delete('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPB_TipoFormaDePago']);

      //habilitar Tipo FormaDePago
      Route::put('parametria/tipoformadepago/habilitar',[TipoFormaDePagoController::class, 'SPH_TipoFormaDePago']);

      //-------------------------SUBMODULO DE Sucursal-------------------------


      //agregar Tipo Sucursal
      Route::post('parametria/sucursales',[SucursalController::class, 'SPA_Sucursal']);

      //editar Tipo Sucursal
      Route::put('parametria/sucursales',[SucursalController::class, 'SPM_Sucursal']);

      //borrar Tipo Sucursal
      Route::delete('parametria/sucursales',[SucursalController::class, 'SPB_Sucursal']);

      //Habilitar Tipo Sucursal
      Route::put('parametria/sucursales/habilitar',[SucursalController::class, 'SPH_Sucursal']);

      //-------------------------SUBMODULO DE TipoModulo-------------------------


      //TODO--------------------------------------MODULO DE RECURSOS--------------------------------------------

      //-------------------------SUBMODULO DE Stock-------------------------


      //agregar Producto
      Route::post('recursos/inventario',[StockController::class, 'SPA_Producto']);

      //editar Producto
      Route::put('recursos/inventario',[StockController::class, 'SPM_Producto']);

      //borrar Producto
      Route::delete('recursos/inventario',[StockController::class, 'SPB_Producto']);

      //habilitar Producto
      Route::put('recursos/inventario/habilitar',[StockController::class, 'SPH_Producto']);

      //-------------------------SUBMODULO DE Personal-------------------------

      //agregar Personal
      Route::post('recursos/personal',[PersonalController::class, 'SPA_Personal']);

      //editar Personal
      Route::put('recursos/personal',[PersonalController::class, 'SPM_Personal']);

      //borrar Personal
      Route::delete('recursos/personal',[PersonalController::class, 'SPB_Personal']);

      //habilitar Personal
      Route::put('recursos/personal/habilitar',[PersonalController::class, 'SPH_Personal']);


      //-------------------------SUBMODULO DE Cliente-------------------------


      //agregar Cliente
      Route::post('recursos/clientes',[ClienteController::class, 'SPA_Clientes']);

      //editar Cliente
      Route::put('recursos/clientes',[ClienteController::class, 'SPM_Cliente']);

      //borrar Cliente
      Route::delete('recursos/clientes',[ClienteController::class, 'SPB_Cliente']);

      //habilitar Cliente
      Route::put('recursos/clientes/habilitar',[ClienteController::class, 'SPH_Cliente']);


      //-------------------------SUBMODULO DE Cliente-------------------------


      //agregar Proveedor
      Route::post('recursos/proveedores',[ProveedorController::class, 'SPA_Proveedor']);

      //editar Proveedor
      Route::put('recursos/proveedores',[ProveedorController::class, 'SPM_Proveedor']);

      //borrar Proveedor
      Route::delete('recursos/proveedores',[ProveedorController::class, 'SPB_Proveedor']);

      //habilitar Proveedor
      Route::put('recursos/proveedores/habilitar',[ProveedorController::class, 'SPH_Proveedor']);

});

//TODO--------------------------------------MODULO DE HOME--------------------------------------------
//obtener cantidad de personal por sucursal
Route::get('SPG_ObtenerCantPersonalPorSucursal',[Graficos::class, 'SPG_ObtenerCantPersonalPorSucursal']);

//obtener cantidad de personal total de la empresa
Route::get('SPG_ObtenerCantPersonalTotal',[Graficos::class, 'SPG_ObtenerCantPersonalTotal']);

//obtener stock total de cada sucursal
Route::get('SPG_ObtenerStockSucursal',[Graficos::class, 'SPG_ObtenerStockSucursal']);

//obtener stock total por cada sucursal de una categoria
Route::get('SPG_ObtenerStockSucursalPorCategoria',[Graficos::class, 'SPG_ObtenerStockSucursalPorCategoria']);

//obtener cantidad de productos totales que tiene la empresa
Route::get('SPG_ObtenerCantProductos',[Graficos::class, 'SPG_ObtenerCantProductos']);

//obtener stock total de cada sucursal
Route::get('SPG_ObtenerCantProductosPorSucursal',[Graficos::class, 'SPG_ObtenerCantProductosPorSucursal']);

//hasta aca anda todo falta agregar el modulo de recursos
