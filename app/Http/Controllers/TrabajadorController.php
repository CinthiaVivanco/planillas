<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Trabajador,App\Estadocivil,App\Empresa,App\Local,App\Cargo,App\Horario,App\Paisemisordocumento,App\Contrato;
use App\Detallejornadalaboral,App\Convenio,App\Situacioneducativa,App\Institucion,App\Carrera,App\Categoria;
use View;
use ZipArchive;
use Session;
use Hashids;

class TrabajadorController extends Controller
{
	
 	public function actionDatoBajaTrabajador(Request $request){

		$dni 						= strtoupper($request['dni']);
		$trabajador     			= Trabajador::where('dni', '=', $dni)->first();


		$situacion 					= DB::table('situaciones')
								  		->where('id','<>',$this->prefijomaestro.'000000000002')
								  		->pluck('descripcionabreviada','id')
								  		->toArray();
								  		
		$combosituacion		    	= array('' => "Seleccione Situación") + $situacion;

		$motivobaja					= DB::table('motivobajas')->pluck('descripcionabreviada','id')->toArray();
		$combomotivobaja			= array('' => "Seleccione Motivo Baja") + $motivobaja;


		return View::make('usuario/ajax/bajadatotrabajador',
						 [
						 	'trabajador' 		    => $trabajador,
						  	'combosituacion' 		=> $combosituacion,
						  	'combomotivobaja' 		=> $combomotivobaja						 	
						 ]);
 	}

	public function actionBajaTrabajador($idopcion,Request $request)
	{

	    /******************* validar url **********************/
		$validarurl   = $this->funciones->getUrl($idopcion,'Modificar');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

		if($_POST)
		{

			$idtrabajador   					  = $request['trabajador_id'];

			$cabecera            	 	 		  =		Trabajador::find($idtrabajador);
			$cabecera->situacion_id				  = 	$request['situacion_id'];
			$cabecera->motivobaja_id			  = 	$request['motivobaja_id'];
			$cabecera->activo 	 		 		  =  	0;
			$cabecera->IdUsuarioModifica 		  = 	Session::get('usuario')->id;
			$cabecera->FechaModifica 			  =     $this->fechaActual;
			$cabecera->save();

			$trabajador 						  = 	Trabajador::where('id','=',$idtrabajador)->first();

 			return Redirect::to('/gestion-baja-trabajador/'.$idopcion)->with('bienhecho', 'Trabajador '.$trabajador->nombres.' '.$trabajador->apellidopaterno.' '.$trabajador->apellidomaterno.' dado de Baja');

		}else{

				$motivobaja				= DB::table('motivobajas')->pluck('descripcionabreviada','id')->toArray();
				$combomotivobaja		= array('' => "Seleccione Motivo Baja") + $motivobaja;


				$situacion 				= DB::table('situaciones')
										  ->where('id','<>',$this->prefijomaestro.'000000000002')
										  ->pluck('descripcionabreviada','id')
										  ->toArray();

				$combosituacion		    = array('' => "Seleccione Situación") + $situacion;

			

			return View::make('trabajador/bajatrabajador',
						[
						  	'idopcion' 				=> $idopcion,
						  	'combosituacion' 		=> $combosituacion,
						  	'combomotivobaja' 		=> $combomotivobaja
						]);
		}

		
	}



	public function actionFichaTrabajador(Request $request){

		$id 						= strtoupper($request['id']);
		$trabajador     			= Trabajador::where('id', '=', $id)->first();
		$fichasocioeconomica     	= Fichasocioeconomica::where('id', '=', $id)->first();
		
		return View::make('usuario/ajax/datotrabajador',
						 [
						 	'trabajador' 			 => $trabajador,
						 	'fichasocioeconomica' 	 => $fichasocioeconomica
						 ]);
 	}

	public function actionListarTrabajador($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $listatrabajadores = Trabajador::where('local_id','=',Session::get('local')->id)->orderBy('id', 'asc')->get();

		return View::make('trabajador/listatrabajadores',
						 [
						 	'listatrabajadores' => $listatrabajadores,
						 	'idopcion' => $idopcion,
						 ]);
	}


	public function actionAgregarTrabajador($idopcion,Request $request)
	{

	
		/********************** validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Anadir');
	    if($validarurl <> 'true'){return $validarurl;}
	    /*********************************************************/



		if($_POST) 
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'dni' => 'unique:trabajadores',
			], [
            	'dni.unique' => 'DNI ya registrado',
        	]);
			/******************************/

			$idtrabajador 		 				 = $this->funciones->getCreateId('trabajadores');

			
			$cabecera            	 	 		 =	new Trabajador;
			$cabecera->id 	     	 	 		 =  $idtrabajador;
			$cabecera->dni 	     		 		 =  $request['dni'];
			$cabecera->apellidopaterno 	 		 =  $request['apellidopaterno'];
			$cabecera->apellidomaterno 	 		 = 	$request['apellidomaterno'];
			$cabecera->nombres  		 		 =	$request['nombre'];
			$cabecera->telefono  		 		 =	$request['telefono'];
			$cabecera->email  			 		 =	$request['email'];
			$cabecera->tipodocumento_id  		 = 	$request['tipodocumento_id'];
			$cabecera->estadocivil_id 	 		 = 	$request['estadocivil_id'];
			$cabecera->nacionalidad_id   		 = 	$request['nacionalidad_id'];
			$cabecera->pais_id   		 		 = 	$request['pais_id'];
			$cabecera->departamento_id   		 = 	$request['departamento_id'];
			$cabecera->provincia_id   			 = 	$request['provincia_id'];
			$cabecera->distrito_id   			 = 	$request['distrito_id'];
			$cabecera->tipovia_id 		 		 = 	$request['tipovia_id'];
			$cabecera->nombrevia 		 		 =	$request['nombrevia'];
			$cabecera->numerovia 		 		 =	$request['numerovia'];
			$cabecera->interior 		 		 =	$request['numerovia'];
			$cabecera->manzana 		 		 	 =	$request['manzana'];
			$cabecera->lote 		 		 	 =	$request['lote'];
			$cabecera->kilometro 		 		 =	$request['kilometro'];
			$cabecera->bloque 		 		 	 =	$request['bloque'];
			$cabecera->etapa 		 		 	 =	$request['etapa'];

			$cabecera->tipozona_id 	 	 		 = 	$request['tipozona_id'];
			$cabecera->nombrezona		 		 =	$request['nombrezona'];
			$cabecera->referencia		 		 =	$request['referencia'];
			$cabecera->convenio_id		 		 =	$request['convenio_id'];
			//$cabecera->categoria_id		 		 =	$request['categoria_id'];

			$cabecera->tipotrabajador_id 		 = 	$request['tipotrabajador_id'];
			$cabecera->paisemisordocumento_id 	 = 	$request['paisemisordocumento_id'];
			$cabecera->codigotelefono_id 	 	 = 	$request['codigotelefono_id'];

			$cabecera->entidadfinanciera_id 	 = 	$request['entidadfinanciera_id'];
			$cabecera->sexo 		 	 		 = 	$request['sexo'];
			$cabecera->discapacidad 			 = 	$request['discapacidad'];
			$cabecera->sindicalizado 			 = 	$request['sindicalizado'];
			$cabecera->regimensalud_id 			 = 	$request['regimensalud_id'];
			$cabecera->regimenpensionario_id	 = 	$request['regimenpensionario_id'];
			$cabecera->cussp  	 				 =	$request['cussp'];
			$cabecera->codigoeps_id 			 = 	$request['codigoeps_id'];

			$cabecera->afiliadoeps 		 		 = 	$request['afiliadoeps'];
			$cabecera->essaludvida 		 		 = 	$request['essaludvida'];
			$cabecera->senati 		 	 		 = 	$request['senati'];
			$cabecera->sctrsalud 		 		 = 	$request['sctrsalud'];
			$cabecera->sctrpensiones 			 = 	$request['sctrpensiones'];
			$cabecera->domiciliado 		 		 = 	$request['domiciliado'];
			$cabecera->situacioneducativa_id	 = 	$request['situacioneducativa_id'];
			$cabecera->estudiosperu				 = 	$request['estudiosperu'];
			$cabecera->regimeninstitucion_id	 = 	$request['regimeninstitucion_id'];
			$cabecera->tipoinstitucion_id   	 = 	$request['tipoinstitucion_id'];
			$cabecera->institucion_id   		 = 	$request['institucion_id'];
			$cabecera->carrera_id   			 = 	$request['carrera_id'];
			$cabecera->anioegreso 	        	 =  $request['anioegreso'];
			$cabecera->regimenlaboral_id   		 = 	$request['regimenlaboral_id'];
			$cabecera->categoriaocupacional_id   = 	$request['categoriaocupacional_id'];
			$cabecera->ocupacion_id   			 = 	$request['ocupacion_id'];
			$cabecera->local_id 				 = 	Session::get('local')->id; // que tenemos que guardar? el id que hemos ok
			
			$cabecera->IdUsuarioCrea 			 = 	Session::get('usuario')->id;

			$cabecera->FechaCrea 				 =  $this->fechaActual;

			$cabecera->situacionespecial_id		 = 	$request['situacionespecial_id'];	
			$cabecera->rentaquinta 		 	 	 = 	$request['rentaquinta'];
			$cabecera->quintaexonerada 		 	 = 	$request['quintaexonerada'];
			$cabecera->asignacionfamiliar 		 = 	$request['asignacionfamiliar'];
			$cabecera->nrohijos 		 		 = 	$request['nrohijos'];
			$cabecera->fechanacimiento 			 = 	$request['fechanacimiento'];
			$cabecera->template 		 		 = 	'';
			$cabecera->template10 			 	 = 	'';
			$cabecera->mar_huella 			 	 = 	'';
			$cabecera->mar_dni 				 	 = 	'';
			$cabecera->otrarentaquinta  		 = 	$request['otrarentaquinta'];
			$cabecera->horario_id  				 = 	$request['horario_id'];



			$cabecera->save();
 			return Redirect::to('/gestion-de-trabajador/'.$idopcion)->with('bienhecho', 'Trabajador '.$request['nombre'].' '.$request['apellidopaterno'].' registrado con éxito');


		}else{

			$tipodocumento 				 = DB::table('tipodocumentos')
									  		->whereIn('id', [$this->prefijomaestro.'000000000001', $this->prefijomaestro.'000000000002',$this->prefijomaestro.'000000000004', $this->prefijomaestro.'000000000005'])
									  		->pluck('descripcion','id')
									  		->toArray();


			$combotipodocumento  		 = array('' => "Seleccione Tipo Documento") + $tipodocumento;

			$estadocivil 				 = DB::table('estadocivils')->pluck('nombre','id')->toArray();
			$comboestadocivil  			 = array('' => "Seleccione Estado Civil") + $estadocivil;

			$nacionalidad 				 = DB::table('nacionalidades')->pluck('nombre','id')->toArray();
			$combonacionalidad 			 = array('' => "Seleccione Nacionalidad") + $nacionalidad;

			$pais 				 		 = DB::table('paises')->pluck('nombre','id')->toArray();
			$combopais 			 		 = array('' => "Seleccione Pais") + $pais ;

			$departamento 				 = DB::table('departamentos')->pluck('nombre','id')->toArray();
			$combodepartamento			 = array('' => "Seleccione Departamento") + $departamento;

			$comboprovincia				 = array('' => "Seleccione Provincia");

			$combodistrito				 = array('' => "Seleccione Distrito");

			$tipovia 					 = DB::table('tipovias')->pluck('descripcion','id')->toArray();
			$combotipovia				 = array('' => "Seleccione Vía") + $tipovia;

			$tipozona 					 = DB::table('tipozonas')->pluck('descripcion','id')->toArray();
			$combotipozona				 = array('' => "Seleccione Zona") + $tipozona;


			$tipotrabajador 			 = DB::table('tipotrabajadores')
								  		   ->where('activo','=',1)->pluck('descripcion','id')->toArray();


			$combotipotrabajador		 = array('' => "Seleccione Tipo Trabajador") + $tipotrabajador;

			$paisemisordocumento		 = DB::table('paisemisordocumentos')->pluck('descripcion','id')->toArray();
			$combopaisemisordocumento	 = array('' => "Seleccione Pais Emisor") + $paisemisordocumento;

			$codigotelefono		 		 = DB::table('codigotelefonos')->pluck('descripcionabreviada','id')->toArray();
			$combocodigotelefono	 	 = array('' => "Seleccione Cód") + $codigotelefono;

			$entidadfinanciera 			 = DB::table('entidadfinancieras')->pluck('entidad','id')->toArray();
			$comboentidadfinanciera		 = array('' => "Seleccione Entidad") + $entidadfinanciera;

			$regimensalud 				 = DB::table('regimensaluds')->pluck('descripcionabreviada','id')->toArray();
			$comboregimensalud			 = array('' => "Seleccione Regimen Salud") + $regimensalud;

			$regimenpensionario 		 = DB::table('regimenpensionarios')->pluck('descripcionabreviada','id')->toArray();
			$comboregimenpensionario	 = array('' => "Seleccione Regimen Pensionario") + $regimenpensionario;

			$codigoeps 					 = DB::table('codigoeps')->pluck('descripcion','id')->toArray();
			$combocodigoeps				 = array('' => "Seleccione EPS") + $codigoeps;

			$convenio 					 = DB::table('convenios')->pluck('descripcion','id')->toArray();
			$comboconvenio			 	 = array('' => "Seleccione Convenio") + $convenio;

			$situacioneducativa			 = DB::table('situacioneducativas')->pluck('descripcionabreviada','id')->toArray();
			$combosituacioneducativa	 = array('' => "Nivel Instrucción") + $situacioneducativa;

			$regimeninstitucion 		 = DB::table('regimeninstituciones')->pluck('nombre','id')->toArray();
			$comboregimeninstitucion	 = array('' => "Seleccione Regimen Institucion") + $regimeninstitucion;

			$combotipoinstitucion		 = array('' => "Seleccione Tipo Institución");

			$comboinstitucion			 = array('' => "Seleccione Institución");

			$combocarrera				 = array('' => "Seleccione Carrera");


			$regimenlaboral 			 = DB::table('regimenlaborales')
								  		   ->where('activo','=',1)->pluck('descripcionabreviada','id')->toArray();

			$comboregimenlaboral		 = array('' => "Seleccione Regimen Laboral") + $regimenlaboral;

			$categoriaocupacional 		 = DB::table('categoriaocupacionales')
								  		   ->where('activo','=',1)->pluck('descripcion','id')->toArray();

			$combocategoriaocupacional	 = array('' => "Seleccione Categoria Ocupacional") + $categoriaocupacional;

			$ocupacion 				  	 = DB::table('ocupaciones')->pluck('descripcion','id')->toArray();
			$comboocupacion 		  	 = array('' => "Seleccione Ocupacion") + $ocupacion;

			$empresa 					 = $this->funciones->getEmpresa();

			$situacionespecial			 = DB::table('situacionespeciales')->pluck('descripcionabreviada','id')->toArray();
			$combosituacionespecial		 = array('' => "Seleccione Situación Especial") + $situacionespecial;

			$horario			 		 = DB::table('horarios')->pluck('nombre','id')->toArray();
			$combohorario		 		 = array('' => "Seleccione Horario") + $horario;

			$ffin 						 = $this->fin;



			return View::make('trabajador/agregartrabajador',
						[
							'combotipodocumento' 			=> $combotipodocumento,
						  	'idopcion' 						=> $idopcion,
						  	'comboestadocivil'	    		=> $comboestadocivil,					
						  	'combonacionalidad' 			=> $combonacionalidad,
						  	'combopais' 					=> $combopais,							
						  	'combodepartamento' 			=> $combodepartamento,
						  	'comboprovincia' 				=> $comboprovincia,
						  	'combodistrito' 				=> $combodistrito,
						  	'combotipovia' 					=> $combotipovia,						  
						  	'combotipozona' 				=> $combotipozona,			  	
					  		'combotipotrabajador' 			=> $combotipotrabajador,

					  		'combopaisemisordocumento' 	    => $combopaisemisordocumento,	
					  		'combocodigotelefono' 	    	=> $combocodigotelefono,	
					  		'comboconvenio' 	    		=> $comboconvenio,		 
						  							
						  	'comboentidadfinanciera'		=> $comboentidadfinanciera,
						  	'comboregimensalud' 			=> $comboregimensalud,
						  	'comboregimenpensionario' 		=> $comboregimenpensionario,
						  	'combocodigoeps'		    	=> $combocodigoeps,

						  	'combosituacioneducativa' 		=> $combosituacioneducativa,
						  	'comboregimeninstitucion' 		=> $comboregimeninstitucion,
						  	'combotipoinstitucion' 			=> $combotipoinstitucion,
						  	'comboinstitucion' 				=> $comboinstitucion,
						  	'combocarrera' 					=> $combocarrera,
						  	'comboregimenlaboral' 			=> $comboregimenlaboral,
						  	'combocategoriaocupacional' 	=> $combocategoriaocupacional,
						  	'comboocupacion' 				=> $comboocupacion,
						  	'combosituacionespecial'	    => $combosituacionespecial,
						  	'combohorario'	    			=> $combohorario,
						  	'ffin'	  					    => $ffin,						
						]);

		}
	}


	public function actionModificarTrabajador($idopcion,$idtrabajador,Request $request)
	{


		/******************* validar url **********************/
		$validarurl   = $this->funciones->getUrl($idopcion,'Modificar');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $idtrabajador = $this->funciones->decodificar($idtrabajador);
	    //$empresa 	  = $this->funciones->getEmpresa();
		
		if($_POST)  
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'dni' => 'unique:trabajadores,dni,'.$idtrabajador.',id'
			], [
            	'dni.unique' => 'DNI ya registrado',
        	]);

			/****************************** NACIONALIDAD Y PAIS EMISOR ***********************/

			$nacionalidad = '';
			$paisemisordocumento = '';

			if($request['tipodocumento_id'] != $this->prefijomaestro.'000000000004'){

				$nacionalidad = $this->prefijomaestro.'000000000001';
				$paisemisordocumento = $this->prefijomaestro.'000000000172';

			}else{

				$nacionalidad = $request['nacionalidad_id'];
				$paisemisordocumento = $request['paisemisordocumento_id'];

			}


			/****************************** MODIFICAR TRABAJADOR ******************************/


			$cargo 								= 		Cargo::where('id','=',$request['cargo_id'])->first();
			$cabecera            	 	 		  =		Trabajador::find($idtrabajador);
			//$empresa            	 	 		  =		Empresa::find($empresa->id);

			$cabecera->dni 	     		 		  =  	$request['dni'];
			$cabecera->tipodocumento_id 	      =  	$request['tipodocumento_id'];
			$cabecera->apellidopaterno 	 		  =  	$request['apellidopaterno'];
			$cabecera->apellidomaterno 	 		  = 	$request['apellidomaterno'];
			$cabecera->nombres  		 		  =		$request['nombre'];
			$cabecera->sexo 	 		 		  =  	$request['sexo'];
			$cabecera->telefono  		 		  =		$request['telefono'];
			$cabecera->email  			 		  =		$request['email'];
			$cabecera->estadocivil_id 	 		  = 	$request['estadocivil_id'];

			$cabecera->nacionalidad_id 	 		  = 	$nacionalidad;
			$cabecera->paisemisordocumento_id 	  = 	$paisemisordocumento;

			$cabecera->pais_id 	 		 		  = 	$request['pais_id'];
			$cabecera->departamento_id 	 		  = 	$request['departamento_id'];
			$cabecera->provincia_id 	 		  = 	$request['provincia_id'];
			$cabecera->distrito_id 	 			  = 	$request['distrito_id'];
			$cabecera->tipovia_id 	 	 		  = 	$request['tipovia_id'];
			$cabecera->nombrevia  		 		  =		$request['nombrevia'];
			$cabecera->numerovia  		 		  =		$request['numerovia'];
			$cabecera->interior  		 		  =		$request['interior'];
			$cabecera->manzana 		 		 	  =		$request['manzana'];
			$cabecera->lote 		 		 	  =		$request['lote'];
			$cabecera->kilometro 		 		  =		$request['kilometro'];
			$cabecera->bloque 		 		 	  =		$request['bloque'];
			$cabecera->etapa 		 		 	  =		$request['etapa'];
			$cabecera->nombrezona  		 		  =		$request['nombrezona'];
			$cabecera->referencia  		 		  =		$request['referencia'];

			$cabecera->tipotrabajador_id 		  = 	$request['tipotrabajador_id'];

			$cabecera->codigotelefono_id 	 	  = 	$request['codigotelefono_id'];
			$cabecera->convenio_id 	 	 		  = 	$request['convenio_id'];

			$cabecera->IdUsuarioModifica 		  = 	Session::get('usuario')->id;
			$cabecera->FechaModifica 			  =     $this->fechaActual;
			
			$cabecera->entidadfinanciera_id 	  = 	$request['entidadfinanciera_id'];
			$cabecera->discapacidad 			  = 	$request['discapacidad'];
			$cabecera->sindicalizado 			  = 	$request['sindicalizado'];
			$cabecera->codigoeps_id 			  = 	$request['codigoeps_id'];
			$cabecera->afiliadoeps 		 		  = 	$request['afiliadoeps'];
			$cabecera->regimensalud_id 			  = 	$request['regimensalud_id'];
			$cabecera->regimenpensionario_id	  = 	$request['regimenpensionario_id'];
			$cabecera->cussp  		 			  =		$request['cussp'];
			$cabecera->essaludvida 		 		  = 	$request['essaludvida'];
			$cabecera->senati 		 	 		  = 	$request['senati'];
			$cabecera->sctrsalud 		 		  = 	$request['sctrsalud'];
			$cabecera->sctrpensiones 			  = 	$request['sctrpensiones'];
			$cabecera->domiciliado 	 			  =  	$request['domiciliado'];

			$cabecera->situacioneducativa_id 	  =  	$request['situacioneducativa_id'];
			$cabecera->estudiosperu 			  = 	$request['estudiosperu'];
			$cabecera->anioegreso 	        	  =   	$request['anioegreso'];
			$cabecera->regimenlaboral_id   		  = 	$request['regimenlaboral_id'];
			$cabecera->categoriaocupacional_id    = 	$request['categoriaocupacional_id'];
			$cabecera->ocupacion_id   			  = 	$request['ocupacion_id'];
			$cabecera->situacionespecial_id		  = 	$request['situacionespecial_id'];
			$cabecera->rentaquinta 		 	 	  = 	$request['rentaquinta'];
			$cabecera->quintaexonerada 		 	  = 	$request['quintaexonerada'];
			$cabecera->asignacionfamiliar 		  = 	$request['asignacionfamiliar'];
			$cabecera->nrohijos 		  		  = 	$request['nrohijos'];
			$cabecera->fechanacimiento 			  = 	$request['fechanacimiento'];
			$cabecera->regimeninstitucion_id	  = 	$request['regimeninstitucion_id'];
			$cabecera->tipoinstitucion_id   	  = 	$request['tipoinstitucion_id'];
			$cabecera->institucion_id   		  = 	$request['institucion_id'];
			$cabecera->carrera_id   			  = 	$request['carrera_id'];
			$cabecera->otrarentaquinta  		  = 	$request['otrarentaquinta'];
			$cabecera->horario_id 		  		  = 	$request['horario_id'];
			$cabecera->save();


 			return Redirect::to('/gestion-de-trabajador/'.$idopcion)->with('bienhecho', 'Trabajador '.$request['nombre'].' '.$request['apellidopaterno'].' modificado con éxito');


		}else{

		        $trabajador 					= Trabajador::where('id', $idtrabajador)->first();

		        $tipodocumento 				 	= DB::table('tipodocumentos')
											  		->whereIn('id', [$this->prefijomaestro.'000000000001', $this->prefijomaestro.'000000000002',$this->prefijomaestro.'000000000004', $this->prefijomaestro.'000000000005'])
											  		->pluck('descripcion','id')
											  		->toArray();
				
		        $combotipodocumento  		 	= array($trabajador->tipodocumento_id => $trabajador->tipodocumento->descripcion,'' => "Seleccione Tipo Documento") + $tipodocumento;

				$estadocivil 					= DB::table('estadocivils')->pluck('nombre','id')->toArray();
				$comboestadocivil  				= array($trabajador->estadocivil_id => $trabajador->estadocivil->nombre,'' => "Seleccione Estado Civil") + $estadocivil ;

				if(isset($trabajador->nacionalidad)) {

					$nacionalidad 				= DB::table('nacionalidades')->pluck('nombre','id')->toArray();
					$combonacionalidad  		= array($trabajador->nacionalidad_id => $trabajador->nacionalidad->nombre,'' => "Seleccione Nacionalidad") + $nacionalidad ;

				}else{

					$nacionalidad		 		= DB::table('nacionalidades')->pluck('nombre','id')->toArray();
					$combonacionalidad	 		= array('' => "Seleccione Pais Emisor") + $nacionalidad;

				}


				$pais 							= DB::table('paises')->pluck('nombre','id')->toArray();
				$combopais 						= array($trabajador->pais_id => $trabajador->pais->nombre ,'' => "Seleccione Pais") + $pais ;

				$departamento					= DB::table('departamentos')->pluck('nombre','id')->toArray();
				$combodepartamento  			= array($trabajador->departamento_id => $trabajador->departamento->nombre,'' => "Seleccione Departamento") + $departamento ;

				$provincia						= DB::table('provincias')->where('departamento_id','=',$trabajador->departamento_id)->pluck('nombre','id')->toArray();
				$comboprovincia 				= array($trabajador->provincia_id => $trabajador->provincia->nombre,'' => "Seleccione Provincia") + $provincia ;

				$distrito						= DB::table('distritos')->where('provincia_id','=',$trabajador->provincia_id)->pluck('nombre','id')->toArray();
				$combodistrito  				= array($trabajador->distrito_id => $trabajador->distrito->nombre,'' => "Seleccione Distrito") + $distrito ;

				$tipovia						= DB::table('tipovias')->pluck('descripcion','id')->toArray();
				$combotipovia  					= array($trabajador->tipovia_id => $trabajador->tipovia->descripcion,'' => "Seleccione Tipo Vía") + $tipovia ;

				$tipotrabajador 			 	= DB::table('tipotrabajadores')
									  		   		->where('activo','=',1)->pluck('descripcion','id')->toArray();

				$combotipotrabajador			= array($trabajador->tipotrabajador_id => $trabajador->tipotrabajador ->descripcionabreviada,'' => "Seleccione Tipo Trabajador") + $tipotrabajador ;  

				// $codigotelefono					= DB::table('codigotelefonos')->pluck('descripcionabreviada','id')->toArray();
				// $combocodigotelefono			= array($trabajador->codigotelefono_id => $trabajador->codigotelefono ->descripcionabreviada) + $codigotelefono ;


				if(isset($trabajador->codigotelefono)) {

					$codigotelefono					= DB::table('codigotelefonos')->pluck('descripcionabreviada','id')->toArray();
					$combocodigotelefono			= array($trabajador->codigotelefono_id => $trabajador->codigotelefono ->descripcionabreviada,'' => "Seleccione Cód") + $codigotelefono ;

				}else{

					$codigotelefono		 			= DB::table('codigotelefonos')->pluck('descripcionabreviada','id')->toArray();
					$combocodigotelefono		    = array('' => "Seleccione Código ") + $codigotelefono;

				}

				// $paisemisordocumento			= DB::table('paisemisordocumentos')->pluck('descripcion','id')->toArray();
				// $combopaisemisordocumento		= array($trabajador->paisemisordocumento_id => $trabajador->paisemisordocumento ->descripcion) + $paisemisordocumento ;


				if(isset($trabajador->paisemisordocumento)) {

					$paisemisordocumento			= DB::table('paisemisordocumentos')->pluck('descripcion','id')->toArray();
					$combopaisemisordocumento		= array($trabajador->paisemisordocumento_id => $trabajador->paisemisordocumento ->descripcion,'' => "Seleccione Pais Emisor") + $paisemisordocumento ;

				}else{

					$paisemisordocumento		 = DB::table('paisemisordocumentos')->pluck('descripcion','id')->toArray();
					$combopaisemisordocumento	 = array('' => "Seleccione Pais Emisor") + $paisemisordocumento;

				}



				if(isset($trabajador->convenio)) {

					$convenio			= DB::table('convenios')->pluck('descripcion','id')->toArray();
					$comboconvenio		= array($trabajador->convenio_id => $trabajador->convenio ->descripcion,'' => "Seleccione Convenio") + $convenio ;

				}else{

					$convenio		 = DB::table('convenios')->pluck('descripcion','id')->toArray();
					$comboconvenio	 = array('' => "Seleccione Convenio") + $convenio;

				}


				$entidadfinanciera 				= DB::table('entidadfinancieras')->pluck('entidad','id')->toArray();
				$comboentidadfinanciera 		= array($trabajador->entidadfinanciera_id => $trabajador->entidadfinanciera ->entidad,'' => "Seleccione Entidad Financiera") + $entidadfinanciera ;


				if(isset($trabajador->codigoeps)){

					$codigoeps			= DB::table('codigoeps')->pluck('descripcion','id')->toArray();
					$combocodigoeps		= array($trabajador->codigoeps_id => $trabajador->codigoeps ->descripcion,'' => "Seleccione Código EPS") + $codigoeps ;

				}else{

					$codigoeps		 = DB::table('codigoeps')->pluck('descripcion','id')->toArray();
					$combocodigoeps	 = array('' => "Seleccione Código EPS") + $codigoeps;

				}

				$regimensalud 					= DB::table('regimensaluds')->pluck('descripcionabreviada','id')->toArray();
				$comboregimensalud				= array($trabajador->regimensalud_id => $trabajador->regimensalud ->descripcionabreviada,'' => "Seleccione Regimen Salud") + $regimensalud ;

				$tipozona 					 	= DB::table('tipozonas')->pluck('descripcion','id')->toArray();
				$combotipozona				 	= array($trabajador->tipozona_id => $trabajador->tipozona->descripcion,'' => "Seleccione Tipo Zona") + $tipozona;


				$regimenpensionario 			= DB::table('regimenpensionarios')->pluck('descripcionabreviada','id')->toArray();
				$comboregimenpensionario		= array($trabajador->regimenpensionario_id => $trabajador->regimenpensionario ->descripcionabreviada,'' => "Seleccione Regimen Pensionario") + $regimenpensionario ;


				$situacioneducativa				= DB::table('situacioneducativas')->pluck('descripcionabreviada','id')->toArray();
				$combosituacioneducativa		= array($trabajador->situacioneducativa_id => $trabajador->situacioneducativa ->descripcionabreviada,'' => "Seleccione Sit. Educativa") + $situacioneducativa;


				$regimenlaboral 				= DB::table('regimenlaborales')
									  		 	  ->where('activo','=',1)->pluck('descripcionabreviada','id')->toArray();
				$comboregimenlaboral			= array($trabajador->regimenlaboral_id => $trabajador->regimenlaboral ->descripcion,'' => "Seleccione Reg. Laboral") + $regimenlaboral;

				$categoriaocupacional 		 	= DB::table('categoriaocupacionales')
								  		   			->where('activo','=',1)->pluck('descripcion','id')->toArray();

				$combocategoriaocupacional		= array($trabajador->categoriaocupacional_id => $trabajador->categoriaocupacional ->descripcion,'' => "Seleccione Cat. Ocupacional") + $categoriaocupacional;

				$ocupacion 				  		= DB::table('ocupaciones')->pluck('descripcion','id')->toArray();
				$comboocupacion       			= array($trabajador->ocupacion_id => $trabajador->ocupacion ->descripcion,'' => "Seleccione Ocupación") + $ocupacion;


				$situacionespecial 				= DB::table('situacionespeciales')->pluck('descripcionabreviada','id')->toArray();
				$combosituacionespecial			= array($trabajador->situacionespecial_id => $trabajador->situacionespecial ->descripcionabreviada,'' => "Seleccione Sit. Especial") + $situacionespecial ;

				$horario 				  		= DB::table('horarios')->pluck('nombre','id')->toArray();
				$combohorario       			= array($trabajador->horario_id => $trabajador->horario ->nombre,'' => "Seleccione Horario") + $horario;	


				if(isset($trabajador->regimeninstitucion)) {
					
					$regimeninstitucion				= DB::table('regimeninstituciones')->pluck('nombre','id')->toArray();
					$comboregimeninstitucion  		= array($trabajador->regimeninstitucion_id => $trabajador->regimeninstitucion->nombre,'' => "Seleccione Regimen Institucion") + $regimeninstitucion;

					$tipoinstitucion				= DB::table('tipoinstituciones')
													  ->where('regimeninstitucion_id','=',$trabajador->regimeninstitucion_id)->pluck('nombre','id')->toArray();
					$combotipoinstitucion			= array($trabajador->tipoinstitucion_id => $trabajador->tipoinstitucion->nombre,'' => "Seleccione Tipo Insitucion") + $tipoinstitucion ;


					$institucion					= DB::table('instituciones')->where('tipoinstitucion_id','=',$trabajador->tipoinstitucion_id)
													  ->pluck('nombre','id')->toArray();
					$comboinstitucion  				= array($trabajador->institucion_id => $trabajador->institucion->nombre,'' => "Seleccione Institucion") + $institucion ;


					$carrera						= DB::table('carreras')->where('institucion_id','=',$trabajador->institucion_id)
													  ->pluck('nombre','id')->toArray();
					$combocarrera  					= array($trabajador->carrera_id => $trabajador->carrera->nombre,'' => "Seleccione Carrera") + $carrera ;


				}else{

					$regimeninstitucion 		 = DB::table('regimeninstituciones')->pluck('nombre','id')->toArray();
					$comboregimeninstitucion	 = array('' => "Seleccione Regimen Institucion") + $regimeninstitucion;

					$combotipoinstitucion		 = array('' => "Seleccione Tipo Insitucion");

					$comboinstitucion			 = array('' => "Seleccione Institucion");

					$combocarrera				 = array('' => "Seleccione Carrera");

				}

				$ffin 							= $this->fin;

		        return View::make('trabajador/modificartrabajador', 
		        				[
									'combotipodocumento' 			=> $combotipodocumento,	
									'combotipozona' 				=> $combotipozona,	        					
		        					'trabajador'  	    			=> $trabajador,
		        					'idopcion'  	    			=> $idopcion,
		        					'comboestadocivil'  			=> $comboestadocivil,
		        					'combonacionalidad' 			=> $combonacionalidad,
		        					'combopais' 				    => $combopais,
		        					'combodepartamento' 			=> $combodepartamento,
		        					'comboprovincia' 				=> $comboprovincia,
		        					'combodistrito' 				=> $combodistrito,
		        					'combotipovia' 					=> $combotipovia,        					
		        					'combotipotrabajador' 			=> $combotipotrabajador,  
		        					'combopaisemisordocumento' 	    => $combopaisemisordocumento,      					

		        					'comboentidadfinanciera'		=> $comboentidadfinanciera,
		        					'combocodigoeps'				=> $combocodigoeps, 
		        					'combocodigotelefono'			=> $combocodigotelefono,

		        					'comboconvenio'					=> $comboconvenio,

						  			'comboregimensalud' 			=> $comboregimensalud,
						  			'comboregimenpensionario' 		=> $comboregimenpensionario,
						  			'combosituacioneducativa' 		=> $combosituacioneducativa,
						  			'comboregimenlaboral' 			=> $comboregimenlaboral,
						  			'combocategoriaocupacional' 	=> $combocategoriaocupacional,
						  			'comboocupacion' 				=> $comboocupacion,						  		
						  			'combosituacionespecial' 	  	=> $combosituacionespecial,
						  			'comboregimeninstitucion' 	  	=> $comboregimeninstitucion,
						  			'combotipoinstitucion' 		  	=> $combotipoinstitucion,
						  			'comboinstitucion' 			  	=> $comboinstitucion,
						  			'combocarrera' 				  	=> $combocarrera,
						  			'combohorario' 				  	=> $combohorario,
						  			'ffin'	  					  	=> $ffin,
						
		        				]);



		}
	}



}
