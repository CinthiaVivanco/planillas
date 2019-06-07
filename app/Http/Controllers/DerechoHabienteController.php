<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Trabajador,App\Estadocivil,App\Derechohabiente,App\Paisemisordocumento;
use View;
use Session;
use Hashids;


class DerechoHabienteController extends Controller
{
	public function actionModificarDerechoHabiente($idderechohabiente,$idopcion,$idtrabajador,Request $request)
	{

		/****************************** NACIONALIDAD Y PAIS EMISOR ***********************/

			$paisemisordocumento = '';

			if($request['tipodocumento_id'] != $this->prefijomaestro.'000000000004'){

				$paisemisordocumento = $this->prefijomaestro.'000000000172';

			}else{

				$paisemisordocumento = $request['paisemisordocumento_id'];

			}

			/****************************************************************************/


			$cabecera            	 	 		 =	Derechohabiente::find($idderechohabiente);
			$cabecera->tipodocumento_id  		 = 	$request['tipodocumento_id'];
			$cabecera->dnihabiente 	     		 =  $request['dnihabiente'];
			$cabecera->dniacredita 	     		 =  $request['dniacredita'];
			$cabecera->apellidopaterno 	 		 =  $request['apellidopaterno'];
			$cabecera->apellidomaterno 	 		 = 	$request['apellidomaterno'];
			$cabecera->nombres  		 		 =	$request['nombre'];
			$cabecera->departamento_id   		 = 	$request['departamento_id'];
			$cabecera->provincia_id   			 = 	$request['provincia_id'];
			$cabecera->distrito_id   			 = 	$request['distrito_id'];
			$cabecera->tipovia_id 		 		 = 	$request['tipovia_id'];
			$cabecera->nombrevia 		 		 =	$request['nombrevia'];
			$cabecera->numerovia 		 		 =	$request['numerovia'];
			$cabecera->interior 		 		 =	$request['numerovia'];
			$cabecera->tipozona_id 	 	 		 = 	$request['tipozona_id'];
			$cabecera->nombrezona		 		 =	$request['nombrezona'];
			$cabecera->referencia		 		 =	$request['referencia'];
			$cabecera->sexo 		 	 		 = 	$request['sexo'];
			$cabecera->local_id 				 = 	Session::get('local')->id; 

			$cabecera->telefono  		 		 =	$request['telefono'];
			$cabecera->email  			 		 =	$request['email'];
			$cabecera->codigotelefono_id 	 	 = 	$request['codigotelefono_id'];

			$cabecera->IdUsuarioModifica 		 = 	Session::get('usuario')->id;
			$cabecera->FechaModifica  		     = 	$this->fechaActual;
			
			$cabecera->fechanacimiento 			 = 	$request['fechanacimiento'];
			$cabecera->fechainicio 				 = 	$request['fechainicio'];
			$cabecera->fechafin 				 = 	$request['fechafin'];
			$cabecera->vinculofamiliar_id 		 = 	$request['vinculofamiliar_id'];
			$cabecera->tipodocumentoacredita_id  = 	$request['tipodocumentoacredita_id'];
			$cabecera->tipobaja_id 	 			 = 	$request['tipobaja_id'];
			$cabecera->numeroresolucion 	 	 = 	$request['numeroresolucion'];
			$cabecera->paisemisordocumento_id 	 = 	$paisemisordocumento;


			$cabecera->save();

 			return Redirect::to('/derecho-habiente-trabajador/'.$idopcion.'/'.$idtrabajador)->with('bienhecho', 'DerechoHabiente'.$request['nombre'].' '.$request['apellidopaterno'].' Modificado con éxito');
	}


	public function actionDerechoHabiente($idopcion,$idtrabajador,Request $request)
	{

		$idtrabajadorsd  = $idtrabajador;
	    $idtrabajador = $this->funciones->decodificar($idtrabajador);

		if($_POST)
		{
			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'dnihabiente' => 'unique:derechohabientes',
			], [
            	'dnihabiente.unique' => 'DNI ya registrado',
        	]);
			/******************************/

			$idderechohabiente 		 			 = $this->funciones->getCreateId('derechohabientes');
			
			$cabecera            	 	 		 =	new Derechohabiente;
			$cabecera->id 	     	 	 		 =  $idderechohabiente;
			$cabecera->trabajador_id  		 	 = 	$idtrabajador;
			$cabecera->tipodocumento_id  		 = 	$request['tipodocumento_id'];
			$cabecera->dnihabiente 	     		 =  $request['dnihabiente'];
			$cabecera->dniacredita 	     		 =  $request['dniacredita'];
			$cabecera->apellidopaterno 	 		 =  $request['apellidopaterno'];
			$cabecera->apellidomaterno 	 		 = 	$request['apellidomaterno'];
			$cabecera->nombres  		 		 =	$request['nombre'];
			$cabecera->departamento_id   		 = 	$request['departamento_id'];
			$cabecera->provincia_id   			 = 	$request['provincia_id'];
			$cabecera->distrito_id   			 = 	$request['distrito_id'];
			$cabecera->tipovia_id 		 		 = 	$request['tipovia_id'];
			$cabecera->nombrevia 		 		 =	$request['nombrevia'];
			$cabecera->numerovia 		 		 =	$request['numerovia'];
			$cabecera->interior 		 		 =	$request['numerovia'];
			$cabecera->tipozona_id 	 	 		 = 	$request['tipozona_id'];
			$cabecera->nombrezona		 		 =	$request['nombrezona'];
			$cabecera->referencia		 		 =	$request['referencia'];
			$cabecera->sexo 		 	 		 = 	$request['sexo'];
			$cabecera->fechanacimiento 			 = 	$request['fechanacimiento'];
			$cabecera->fechainicio 				 = 	$request['fechainicio'];
			$cabecera->fechafin 				 = 	$request['fechafin'];
			$cabecera->vinculofamiliar_id 		 = 	$request['vinculofamiliar_id'];
			$cabecera->tipodocumentoacredita_id  = 	$request['tipodocumentoacredita_id'];
			$cabecera->tipobaja_id 	 			 = 	$request['tipobaja_id'];
			$cabecera->numeroresolucion 	 	 = 	$request['numeroresolucion'];
			$cabecera->paisemisordocumento_id 	 = 	$request['paisemisordocumento_id'];
			$cabecera->telefono  		 		 =	$request['telefono'];
			$cabecera->email  		 		 =	$request['email'];

			$cabecera->local_id 				 = 	Session::get('local')->id; 

			$cabecera->IdUsuarioCrea 			 = 	Session::get('usuario')->id;
			$cabecera->FechaCrea  		         = 	$this->fechaActual;

			$cabecera->save();



 			return Redirect::to('/derecho-habiente-trabajador/'.$idopcion.'/'.$idtrabajadorsd)->with('bienhecho', 'DerechoHabiente'.$request['nombre'].' '.$request['apellidopaterno'].' registrado con exito');

		}else{

			$listaderechohabiente 		    = Derechohabiente::where('trabajador_id','=' , $idtrabajador)->get();
			
		    $trabajador 					= Trabajador::where('id', $idtrabajador)->first();
		    
			$tipodocumento 				 	= DB::table('tipodocumentos')
									  			->where('id','<>',$this->prefijomaestro.'000000000003')
									  			->where('id','<>',$this->prefijomaestro.'000000000005')
									  			->where('id','<>',$this->prefijomaestro.'000000000006')
									  			->pluck('descripcion','id')
									  			->toArray();
			$combotipodocumento  		 	= array('' => "Seleccione Tipo Documento") + $tipodocumento;

			$vinculofamiliar 				= DB::table('vinculofamiliares')->pluck('descripcionabreviado','id')->toArray();
			$combovinculofamiliar 		 	= array('' => "Seleccione Vínculo Familiar") + $vinculofamiliar;

			
			$combotipodocumentoacredita 	= array('' => "Seleccione Tipo Doc. Acredita");

			$tipobaja 						= DB::table('tipobajas')->pluck('descripcionabreviado','id')->toArray();
			$combotipobaja					= array('' => "Seleccione Tipo Baja") + $tipobaja;


			$tipovia 					 	= DB::table('tipovias')->pluck('descripcion','id')->toArray();
			$combotipovia					= array('' => "Seleccione Vía") + $tipovia;

			$tipozona 					 	= DB::table('tipozonas')->pluck('descripcion','id')->toArray();
			$combotipozona				 	= array('' => "Seleccione Zona") + $tipozona;

			$departamento 					= DB::table('departamentos')->pluck('nombre','id')->toArray();
			$combodepartamento			 	= array('' => "Seleccione Departamento") + $departamento;

			$comboprovincia				 	= array('' => "Seleccione Provincia");

			$combodistrito				 	= array('' => "Seleccione Distrito");

			$paisemisordocumento		 = DB::table('paisemisordocumentos')->pluck('descripcion','id')->toArray();
			$combopaisemisordocumento	 = array('' => "Seleccione Pais Emisor") + $paisemisordocumento;

			$codigotelefono		 		 = DB::table('codigotelefonos')->pluck('descripcionabreviada','id')->toArray();
			$combocodigotelefono	 	 = array('' => "Seleccione Cód") + $codigotelefono;

	        return View::make('trabajador/derechohabientetrabajador', 
	        				[

	        					'listaderechohabiente'  	    		=> $listaderechohabiente,
	        					'trabajador'  	    					=> $trabajador,
	        					'idopcion'  	    					=> $idopcion,
	        					'combotipodocumento'  	    			=> $combotipodocumento,
	        					'combovinculofamiliar'  	    		=> $combovinculofamiliar,
	        					'combotipodocumentoacredita'  	    	=> $combotipodocumentoacredita,
	        					'combotipobaja'  	    				=> $combotipobaja,
	        					'combotipovia' 							=> $combotipovia,					 
						  		'combotipozona' 						=> $combotipozona,
						  		'combodepartamento' 					=> $combodepartamento,
						  		'comboprovincia' 						=> $comboprovincia,
						  		'combodistrito' 						=> $combodistrito,
						  		'combopaisemisordocumento' 	    		=> $combopaisemisordocumento,
						  		'combocodigotelefono' 	    			=> $combocodigotelefono,	
	        				]);
		}
	}

	public function actionDerechoHabienteAjax(Request $request)
	{

		$id   							= $request['id'];
		$idopcion   					= $request['idopcion'];
		$idtrabajador   				= $request['idtrabajador'];


		$derechohabiente 		    	= Derechohabiente::where('id','=' , $id)->first();

		$tipodocumento 				 	= DB::table('tipodocumentos')->pluck('descripcionabreviado','id')->toArray();
		$combotipodocumento  		 	= array($derechohabiente->tipodocumento_id => $derechohabiente->tipodocumento->descripcionabreviado) + $tipodocumento;


		$vinculofamiliar 				= DB::table('vinculofamiliares')->pluck('descripcionabreviado','id')->toArray();
		$combovinculofamiliar 		 	= array($derechohabiente->vinculofamiliar_id => $derechohabiente->vinculofamiliar->descripcionabreviado) + $vinculofamiliar;


		$tipodocumentoacredita			= DB::table('tipodocumentoacreditas')->where('vinculofamiliar_id','=',$derechohabiente->vinculofamiliar_id)->pluck('descripcionabreviado','id')->toArray();
		$combotipodocumentoacredita 	= array($derechohabiente->tipodocumentoacredita_id => $derechohabiente->tipodocumentoacredita->descripcionabreviado) + $tipodocumentoacredita ;

		$tipobaja 						= DB::table('tipobajas')->pluck('descripcionabreviado','id')->toArray();
		if($derechohabiente->tipobaja_id == '' or $derechohabiente->tipobaja_id == NULL){
			$combotipobaja					= array('' => "Seleccione Tipo Baja") + $tipobaja;
		}else{
			$combotipobaja					= array($derechohabiente->tipobaja_id => $derechohabiente->tipobaja->descripcionabreviado) + $tipobaja;			
		}
		


		$tipovia 					 	= DB::table('tipovias')->pluck('descripcion','id')->toArray();
		$combotipovia					= array($derechohabiente->tipovia_id => $derechohabiente->tipovia->descripcion) + $tipovia;

		$tipozona 					 	= DB::table('tipozonas')->pluck('descripcion','id')->toArray();
		$combotipozona				 	= array($derechohabiente->tipozona_id => $derechohabiente->tipozona->descripcion) + $tipozona;

		$departamento 					= DB::table('departamentos')->pluck('nombre','id')->toArray();
		$combodepartamento			 	= array($derechohabiente->departamento_id => $derechohabiente->departamento->nombre) + $departamento;

		$provincia						= DB::table('provincias')->where('departamento_id','=',$derechohabiente->departamento_id)->pluck('nombre','id')->toArray();
		$comboprovincia 				= array($derechohabiente->provincia_id => $derechohabiente->provincia->nombre) + $provincia ;

		$distrito						= DB::table('distritos')->where('provincia_id','=',$derechohabiente->provincia_id)->pluck('nombre','id')->toArray();
		$combodistrito  				= array($derechohabiente->distrito_id => $derechohabiente->distrito->nombre) + $distrito ;


		if(isset($derechohabiente->paisemisordocumento)) {

			$paisemisordocumento			= DB::table('paisemisordocumentos')->pluck('descripcion','id')->toArray();
			$combopaisemisordocumento		= array($derechohabiente->paisemisordocumento_id => $derechohabiente->paisemisordocumento ->descripcion,'' => "Seleccione Pais Emisor") + $paisemisordocumento ;

		}else{

			$paisemisordocumento		 = DB::table('paisemisordocumentos')->pluck('descripcion','id')->toArray();
			$combopaisemisordocumento	 = array('' => "Seleccione Pais Emisor") + $paisemisordocumento;

		}

		if(isset($derechohabiente->codigotelefono)) {

					$codigotelefono					= DB::table('codigotelefonos')->pluck('descripcionabreviada','id')->toArray();
					$combocodigotelefono			= array($derechohabiente->codigotelefono_id => $derechohabiente->codigotelefono ->descripcionabreviada,'' => "Seleccione Cód") + $codigotelefono ;

		}else{

					$codigotelefono		 			= DB::table('codigotelefonos')->pluck('descripcionabreviada','id')->toArray();
					$combocodigotelefono		    = array('' => "Seleccione Código ") + $codigotelefono;

		}



		return View::make('trabajador/ajax/editdh',
						 [
	        					'id'  	    							=> $id,
	        					'idopcion'  	    					=> $idopcion,
	        					'idtrabajador'  	    				=> $idtrabajador,
	        					'derechohabiente'  	    				=> $derechohabiente,
	        					'combotipodocumento'  	    			=> $combotipodocumento,
	        					'combovinculofamiliar'  	    		=> $combovinculofamiliar,
	        					'combotipodocumentoacredita'  	    	=> $combotipodocumentoacredita,
	        					'combotipobaja'  	    				=> $combotipobaja,
	        					'combotipovia' 							=> $combotipovia,						  
						  		'combotipozona' 						=> $combotipozona,
						  		'combodepartamento' 					=> $combodepartamento,
						  		'comboprovincia' 						=> $comboprovincia,
						  		'combodistrito' 						=> $combodistrito,
						  		'combopaisemisordocumento' 	    		=> $combopaisemisordocumento,    
						  		'combocodigotelefono'					=> $combocodigotelefono,
						 ]);
	}	
}
