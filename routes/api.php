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

//--------------------------------------MODULO DE SEGURIDAD------------------------------------------------------

//-------------------------SUBMODULO DE Usuarios-------------------------
//listar Usuarios
Route::get('seguridad/usuarios',[UsuariosController::class, 'SPL_Usuarios']);

//agregar Usuarios
Route::post('seguridad/usuarios',[UsuariosController::class, 'SPA_Usuarios']);

//editar Usuarios
Route::put('seguridad/usuarios',[UsuariosController::class, 'SPM_Usuarios']);

//borrar Usuarios
Route::delete('seguridad/usuarios',[UsuariosController::class, 'SPB_Usuarios']); 

//agregar rol usuario
Route::post('seguridad/usuarios/rol',[UsuariosController::class, 'SPA_AgregarRolUsuario']);

//listar usuarios por rol
Route::get('seguridad/usuarios/rol',[UsuariosController::class, 'SP_ListaUsuariosRol']);

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

//listar tipo rol
Route::get('seguridad/tiporoles',[tiporolController::class, 'SPL_TipoRol']);

//habilitar tipo rol
Route::put('seguridad/tiporoles',[tiporolController::class, 'SPH_TipoRol']);


//-------------------------SUBMODULO DE RolModulo-------------------------

//listar rol modulo
Route::get('seguridad/rolmodulos',[rolModuloController::class, 'SPL_RolModulo']);

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

//agregar Tipo Producto
Route::post('parametria/tipoproducto',[TipoProductoController::class, 'SPA_TipoProducto']);

//editar Tipo Producto
Route::put('parametria/tipoproducto',[TipoProductoController::class, 'SPM_TipoProducto']);

//borrar Tipo Producto
Route::delete('parametria/tipoproducto',[TipoProductoController::class, 'SPB_TipoProducto']);

//-------------------------SUBMODULO DE TipoCategoria-------------------------
//listar Tipo Categoria
Route::get('parametria/tipocategoria',[TipoCategoriaController::class, 'SPL_TipoCategoria']);

//agregar Tipo Categoria
Route::post('parametria/tipocategoria',[TipoCategoriaController::class, 'SPA_TipoCategoria']);

//editar Tipo Categoria
Route::put('parametria/tipocategoria',[TipoCategoriaController::class, 'SPM_TipoCategoria']);

//borrar Tipo Categoria
Route::delete('parametria/tipocategoria',[TipoCategoriaController::class, 'SPB_TipoCategoria']);


//-------------------------SUBMODULO DE TipoImpuesto-------------------------
//listar Tipo Impuesto
Route::get('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPL_TipoImpuesto']);

//agregar Tipo Impuesto
Route::post('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPA_TipoImpuesto']);

//editar Tipo Impuesto
Route::put('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPM_TipoImpuesto']);

//borrar Tipo Impuesto
Route::delete('parametria/tipoimpuesto',[TipoImpuestoController::class, 'SPB_TipoImpuesto']);

//-------------------------SUBMODULO DE FormaDePago-------------------------
//listar Tipo FormaDePago
Route::get('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPL_TipoFormaDePago']);

//agregar Tipo FormaDePago
Route::post('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPA_TipoFormaDePago']);

//editar Tipo FormaDePago
Route::put('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPM_TipoFormaDePago']);

//borrar Tipo FormaDePago
Route::delete('parametria/tipoformadepago',[TipoFormaDePagoController::class, 'SPB_TipoFormaDePago']);

//-------------------------SUBMODULO DE Sucursal-------------------------
//listar Tipo Sucursal
Route::get('parametria/sucursales',[SucursalController::class, 'SPL_Sucursal']);

//agregar Tipo Sucursal
Route::post('parametria/sucursales',[SucursalController::class, 'SPA_Sucursal']);

//editar Tipo Sucursal
Route::put('parametria/sucursales',[SucursalController::class, 'SPM_Sucursal']);

//borrar Tipo Sucursal
Route::delete('parametria/sucursales',[SucursalController::class, 'SPB_Sucursal']);

//-------------------------SUBMODULO DE TipoModulo-------------------------
//listar TipoModulo
Route::get('parametria/tipomodulo',[TipoModuloController::class, 'SPL_TipoModulo']);

//TODO--------------------------------------MODULO DE RECURSOS--------------------------------------------

//-------------------------SUBMODULO DE Stock-------------------------
//listar Producto
Route::get('gestion/inventario',[StockController::class, 'SPL_Producto']);

//agregar Producto
Route::post('gestion/inventario',[StockController::class, 'SPA_Producto']);

//editar Producto
Route::put('gestion/inventario',[StockController::class, 'SPM_Producto']);

//borrar Producto
Route::delete('gestion/inventario',[StockController::class, 'SPB_Producto']);

//habilitar Producto
Route::put('gestion/inventario',[StockController::class, 'SPH_Producto']);


//-------------------------SUBMODULO DE Personal-------------------------

//lista persona extra
Route::get('lista/personas',[ListaPersonasController::class, 'SP_ListaPersonas']);

//lista localidades extra
Route::get('lista/localidad',[ListaLocalidadesController::class, 'SPL_Localidad']);

//lista provincias extra
Route::get('lista/provincia',[ListaProvinciasController::class, 'SPL_Provincia']);

//listar Personal
Route::get('recursos/personal',[PersonalController::class, 'SPL_Personal']);

//agregar Personal
Route::post('recursos/personal',[PersonalController::class, 'SPA_Personal']);

//editar Personal
Route::put('recursos/personal',[PersonalController::class, 'SPM_Personal']);

//borrar Personal
Route::delete('recursos/personal',[PersonalController::class, 'SPB_Personal']);

//habilitar Personal
Route::put('recursos/personal',[PersonalController::class, 'SPH_Personal']);


//-------------------------SUBMODULO DE Cliente-------------------------
//listar Cliente
Route::get('recursos/clientes',[ClienteController::class, 'SPL_Cliente']);

//agregar Cliente
Route::post('recursos/clientes',[ClienteController::class, 'SPA_Clientes']);

//editar Cliente
Route::put('recursos/clientes',[ClienteController::class, 'SPM_Cliente']);

//borrar Cliente
Route::delete('recursos/clientes',[ClienteController::class, 'SPB_Cliente']);

//habilitar Cliente
Route::put('recursos/clientes',[ClienteController::class, 'SPH_Cliente']);


//-------------------------SUBMODULO DE Cliente-------------------------
//listar Proveedor
Route::get('recursos/proveedores',[ProveedorController::class, 'SPL_Proveedor']);

//agregar Proveedor
Route::post('recursos/proveedores',[ProveedorController::class, 'SPA_Proveedor']);

//editar Proveedor
Route::put('recursos/proveedores',[ProveedorController::class, 'SPM_Proveedor']);

//borrar Proveedor
Route::delete('recursos/proveedores',[ProveedorController::class, 'SPB_Proveedor']);

//habilitar Proveedor
Route::put('recursos/proveedores',[ProveedorController::class, 'SPH_Proveedor']);

//hasta aca anda todo falta agregar el modulo de recursos
