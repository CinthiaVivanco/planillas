<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/********************** USUARIOS *************************/

Route::group(['middleware' => ['guestaw']], function () {

	Route::any('/', 'UserController@actionLogin');
	Route::any('/login', 'UserController@actionLogin');
	Route::any('/ajax-select-local', 'GeneralAjaxController@actionLocalAjax');

}); 

Route::get('/cerrarsession', 'UserController@actionCerrarSesion');

Route::group(['middleware' => ['authaw']], function () {

	Route::get('/bienvenido', 'UserController@actionBienvenido');

	Route::any('/gestion-de-usuarios/{idopcion}', 'UserController@actionListarUsuarios');
	Route::any('/agregar-usuario/{idopcion}', 'UserController@actionAgregarUsuario');
	Route::any('/modificar-usuario/{idopcion}/{idusuario}', 'UserController@actionModificarUsuario');

	Route::any('/ajax-dato-del-trabajador', 'UserController@actionDatoTrabajador');


	Route::any('/gestion-de-roles/{idopcion}', 'UserController@actionListarRoles');
	Route::any('/agregar-rol/{idopcion}', 'UserController@actionAgregarRol');
	Route::any('/modificar-rol/{idopcion}/{idrol}', 'UserController@actionModificarRol');

	Route::any('/gestion-de-permisos/{idopcion}', 'UserController@actionListarPermisos');
	Route::any('/ajax-listado-de-opciones', 'UserController@actionAjaxListarOpciones');
	Route::any('/ajax-activar-permisos', 'UserController@actionAjaxActivarPermisos');

	Route::any('/gestion-de-trabajador/{idopcion}', 'TrabajadorController@actionListarTrabajador');
	Route::any('/agregar-trabajador/{idopcion}', 'TrabajadorController@actionAgregarTrabajador'); 
	Route::any('/modificar-trabajador/{idopcion}/{idtrabajador}', 'TrabajadorController@actionModificarTrabajador');

	Route::any('/gestion-de-t-registro/{idopcion}', 'TRegistroTrabajadorController@actionTRegistro');
	Route::any('/exportar-tregistro/{idopcion}', 'TRegistroTrabajadorController@actionExportarTRegistro');

	// Route::any('/gestion-de-t-registro/{idopcion}', 'TRegistroDerechohabienteController@actionTRegistro');
	// Route::any('/exportar-tregistro/{idopcion}', 'TRegistroDerechohabienteController@actionExportarTRegistro');


	Route::any('/gestion-baja-trabajador/{idopcion}', 'TrabajadorController@actionBajaTrabajador');
	Route::any('/ajax-baja-del-trabajador', 'TrabajadorController@actionDatoBajaTrabajador');

	Route::any('/derecho-habiente-trabajador/{idopcion}/{idtrabajador}', 'DerechoHabienteController@actionDerechoHabiente');
	Route::any('/ajax-form-derechohabiente', 'DerechoHabienteController@actionDerechoHabienteAjax');
	Route::any('/modificar-derecho-habiente-trabajador/{idderechohabiente}/{idopcion}/{idtrabajador}', 'DerechoHabienteController@actionModificarDerechoHabiente');

	Route::any('/ficha-socioeconomica-trabajador/{idopcion}/{idtrabajador}', 'FichaSocioeconomicaController@actionFichaSocioeconomica');
	Route::any('/ajax-form-fichasocioeconomica', 'FichaSocioeconomicaController@actionFichaSocioeconomicaAjax');

	Route::any('/modificar-ficha-socioeconomica-trabajador/{idfichasocioeconomica}/{idopcion}/{idtrabajador}', 'FichaSocioeconomicaController@actionModificarFichaSocioeconomica');

	Route::any('/ajax-ficha-del-trabajador', 'UserController@actionFichaTrabajador');

	Route::any('/ficha-contrato-trabajador/{idopcion}/{idtrabajador}', 'ContratoController@actionContrato');
	Route::any('/modificar-ficha-contrato-trabajador/{idcontrato}/{idopcion}/{idtrabajador}', 'ContratoController@actionModificarContrato');
	Route::any('/contrato-trabajador-pdf/{idcontrato}', 'ContratoReporteController@actionContratoPdf');

	Route::any('/ajax-form-contrato', 'ContratoController@actionContratoAjax');
	Route::any('/ajax-modal-contrato', 'ContratoController@actionContratoModalAjax'); 

	Route::any('/ajax-select-provincia', 'GeneralAjaxController@actionProvinciaAjax');
	Route::any('/ajax-select-distrito', 'GeneralAjaxController@actionDistritoAjax');

	Route::any('/ajax-select-area', 'GeneralAjaxController@actionAreaAjax');
	Route::any('/ajax-select-unidad', 'GeneralAjaxController@actionUnidadAjax');
	Route::any('/ajax-select-cargo', 'GeneralAjaxController@actionCargoAjax');

	Route::any('/ajax-select-tipoinstitucion', 'GeneralAjaxController@actionTipoInstitucionAjax');
	Route::any('/ajax-select-institucion', 'GeneralAjaxController@actionInstitucionAjax');
	Route::any('/ajax-select-carrera', 'GeneralAjaxController@actionCarreraAjax');

	Route::any('/ajax-select-tipodocumentoacredita', 'GeneralAjaxController@actionTipoDocumentoAcreditaAjax');

	Route::any('/gestion-de-horario/{idopcion}', 'HorarioController@actionListarSemanas');
	Route::any('/ajax-listado-de-horario', 'HorarioController@actionAjaxListarHorario');
	Route::any('/ajax-activar-horario-trabajador', 'HorarioController@actionAjaxActivarHorarioTrabajador');
	Route::any('/ajax-select-horario-trabajador', 'HorarioController@actionAjaxSelectHorarioTrabajador');
	Route::any('/ajax-clonar-horario', 'HorarioController@actionAjaxClonarHorario');
	Route::any('/ajax--copiar-horario-clonado', 'HorarioController@actionAjaxCopiarHorarioClonado');
	Route::any('/horario-semana-pdf/{idsemana}', 'HorarioReporteController@actionHorarioSemanaPdf');


	/***************** planillas *****************/

	Route::any('/gestion-de-rubros/{idopcion}', 'RubroController@actionListarRubros');
	Route::any('/agregar-rubro/{idopcion}', 'RubroController@actionAgregarRubro');
	Route::any('/modificar-rubro/{idopcion}/{idrubro}', 'RubroController@actionModificarRubro');
	Route::any('/ajax-actualizar-rubro-trabajador', 'RubroController@actionAjaxActualizarRubroTrabajador');

	Route::any('/gestion-de-rubros-trabajador/{idopcion}', 'RubroController@actionRubroxTrabajador');
	Route::any('/lista-de-rubros-json.json', 'RubroController@actionListaderubrosjson');
	Route::any('/ajax-listado-de-trabajadores-x-rubro', 'RubroController@actionAjaxListadoTrabajadoresxRubro'); //
	Route::any('/ajax-monto-del-trabajadores-x-rubro', 'RubroController@actionAjaxMontoTrabajadoresxRubro');

	Route::any('/gestion-de-trabajador-rubro/{idopcion}', 'RubroController@actionTrabajadorxRubro'); //
	Route::any('/lista-de-trabajadores-json.json', 'RubroController@actionListadetrabajadoresjson'); //
	Route::any('/ajax-listado-de-rubros-x-trabajador', 'RubroController@actionAjaxListadoRubroxTrabajadores');
	
	Route::any('/prueba-email-cumpleanio', 'UserController@pruebaemailcumpleanios');

	/************************************ Mantenimiento ********************************************/

	Route::any('/gestion-de-afp/{idopcion}', 'MantenimientoController@actionListarAfp');
	Route::any('/agregar-afp/{idopcion}', 'MantenimientoController@actionAgregarAfp');
	Route::any('/modificar-afp/{idopcion}/{idafp}', 'MantenimientoController@actionModificarAfp');

	Route::any('/gestion-de-bancos/{idopcion}', 'MantenimientoController@actionListarBancos');
	Route::any('/agregar-bancos/{idopcion}', 'MantenimientoController@actionAgregarBancos');
	Route::any('/modificar-bancos/{idopcion}/{idbanco}', 'MantenimientoController@actionModificarBancos');



});

	Route::any('/pruebas', 'UserController@pruebas');


	//	Route::any('/ajax-listado-de-trabajadores-x-rubro', 'RubroController@actionAjaxListadoTrabajadoresxRubro'); 
	//  Route::any('/gestion-de-trabajador-rubro/{idopcion}', 'RubroController@actionTrabajadorxRubro'); 
	//  Route::any('/lista-de-trabajadores-json.json', 'RubroController@actionListadetrabajadoresjson'); //