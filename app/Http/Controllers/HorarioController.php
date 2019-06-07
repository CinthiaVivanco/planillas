<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Semana,App\Trabajador,App\Horario,App\Horariotrabajador,App\Asistenciatrabajador;
use App\Horariotrabajadoresclonado;
use View;
use Session;
use Hashids;


class HorarioController extends Controller
{

	public function actionListarSemanas($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $listasemana 	= Semana::orderBy('numero', 'asc')->get();
	    $hoy 			= date_format(date_create($this->fin), 'Y-m-d');

		return View::make('horario/listasemanas',
						 [
						 	'listasemana' 	=> $listasemana,
						 	'idopcion' 		=> $idopcion,
						 	'hoy' 	   		=> $hoy,
						 ]);


	}




	public function actionAjaxListarHorario(Request $request)
	{


		$idsemana 				=  	$request['idsemana'];
		$idsemana 				= 	$this->funciones->decodificarmaestra($idsemana);

		$listatrabajadores 		= 	Trabajador::where('id','<>',$this->prefijomaestro.'000000000001')
							 		->orderBy('id', 'asc')
							 		->get();

		$semana            		=   Semana::where('id','=',$idsemana)->first();

		$horario            	=   Horario::where('id','=',$this->prefijomaestro.'000000000001')->first();
		$fechainicio 			= 	$semana->fechainicio;



		$horariotrabajador 		= 	Horariotrabajador::where('semana_id','=',$idsemana)->first();

		if(count($horariotrabajador)<=0){

			foreach($listatrabajadores as $item){

				$idhorariotrabajador 		= 	$this->funciones->getCreateId('horariotrabajadores');
				$idasistenciatrabajadores 	= 	$this->funciones->getCreateId('asistenciatrabajadores');

			    $cabecera            		=	new Horariotrabajador;
			    $cabecera->id 	    		=  	$idhorariotrabajador;
				$cabecera->luh 				= 	1;
				$cabecera->lud    			=  	$fechainicio;
				$cabecera->hlu 				= 	$item->horario_id;
				$cabecera->rhlu 			= 	$item->horario->horainicio.' - '.$item->horario->horafin;

				$cabecera->mah 				= 	1;
				$cabecera->mad    			=  	date('Y-m-d' ,strtotime('+1 day',strtotime($fechainicio)));
				$cabecera->hma 				= 	$item->horario_id;
				$cabecera->rhma 			= 	$item->horario->horainicio.' - '.$item->horario->horafin;

				$cabecera->mih 				= 	1;
				$cabecera->mid    			=  	date('Y-m-d' ,strtotime('+2 day',strtotime($fechainicio)));
				$cabecera->hmi 				= 	$item->horario_id;
				$cabecera->rhmi 			= 	$item->horario->horainicio.' - '.$item->horario->horafin;				

				$cabecera->juh 				= 	1;
				$cabecera->jud    			=  	date('Y-m-d' ,strtotime('+3 day',strtotime($fechainicio)));
				$cabecera->hju 				= 	$item->horario_id;
				$cabecera->rhju 			= 	$item->horario->horainicio.' - '.$item->horario->horafin;					

				$cabecera->vih 				= 	1;
				$cabecera->vid    			=  	date('Y-m-d' ,strtotime('+4 day',strtotime($fechainicio)));
				$cabecera->hvi 				= 	$item->horario_id;
				$cabecera->rhvi 			= 	$item->horario->horainicio.' - '.$item->horario->horafin;					

				$cabecera->sah 				= 	1;
				$cabecera->sad    			=  	date('Y-m-d' ,strtotime('+5 day',strtotime($fechainicio)));
				$cabecera->hsa 				= 	$item->horario_id;
				$cabecera->rhsa 			= 	$item->horario->horainicio.' - '.$item->horario->horafin;				

				$cabecera->doh 				= 	1;
				$cabecera->dod    			=  	date('Y-m-d' ,strtotime('+6 day',strtotime($fechainicio)));
				$cabecera->hdo 				= 	$item->horario_id;
				$cabecera->rhdo 			= 	$item->horario->horainicio.' - '.$item->horario->horafin;					

			    $cabecera->trabajador_id 	=  	$item->id;
			    $cabecera->semana_id 		=  	$idsemana;
			    $cabecera->local_id 		=  	Session::get('local')->id;		    
				$cabecera->save();

			    $cabecera            				=	new Asistenciatrabajador;
			    $cabecera->id 	    				=  	$idasistenciatrabajadores;

				$cabecera->lud    					=  	$fechainicio;
			    $cabecera->hlu 						=  	$item->horario_id; 
			    $cabecera->lucantmarc 				=  	$item->horario->marcacion;


				$cabecera->mad    					=  	date('Y-m-d' ,strtotime('+1 day',strtotime($fechainicio)));
			    $cabecera->hma 						=  	$item->horario_id;
			    $cabecera->macantmarc 				=  	$item->horario->marcacion;

				$cabecera->mid    					=  	date('Y-m-d' ,strtotime('+2 day',strtotime($fechainicio)));
			    $cabecera->hmi 						=  	$item->horario_id;
			    $cabecera->micantmarc 				=  	$item->horario->marcacion;

				$cabecera->jud    					=  	date('Y-m-d' ,strtotime('+3 day',strtotime($fechainicio)));
			    $cabecera->hju 						=  	$item->horario_id;
			    $cabecera->jucantmarc 				=  	$item->horario->marcacion;

				$cabecera->vid    					=  	date('Y-m-d' ,strtotime('+4 day',strtotime($fechainicio)));
			    $cabecera->hvi 						=  	$item->horario_id;
			    $cabecera->vicantmarc 				=  	$item->horario->marcacion;

				$cabecera->sad    					=  	date('Y-m-d' ,strtotime('+5 day',strtotime($fechainicio)));
			    $cabecera->hsa 						=  	$item->horario_id;
			    $cabecera->sacantmarc 				=  	$item->horario->marcacion;

				$cabecera->dod    					=  	date('Y-m-d' ,strtotime('+6 day',strtotime($fechainicio)));
			    $cabecera->hdo 						=  	$item->horario_id;
			    $cabecera->docantmarc 				=  	$item->horario->marcacion;		

			    $cabecera->trabajador_id 			=  	$item->id;
			    $cabecera->semana_id 				=  	$idsemana;
			    $cabecera->horariotrabajador_id 	=  	$idhorariotrabajador;
			    $cabecera->local_id 				=  	Session::get('local')->id;			    
				$cabecera->save();

			}
		}

		$horario 		= DB::table('horarios')->pluck('nombre','id')->toArray();
		$combohorario  	= $horario;

		$listahorario 	= Horariotrabajador::where('semana_id','=',$idsemana)->get();

		return View::make('horario/ajax/listahorariopersonal',
						 [
							 'listahorario'   => $listahorario,
							 'combohorario'   => $combohorario
						 ]);
	}

	public function actionAjaxActivarHorarioTrabajador(Request $request)
	{

		$dia 						= 	$request['dia'].'d';
		$idhorariotrabajadores 		=  	$request['name'];
		$idhorariotrabajadores 		= 	$this->funciones->decodificar($idhorariotrabajadores);

		$response 					= 	$this->funciones->getDiaAnterior($idhorariotrabajadores,$dia);
		if($response[0]['error']){echo json_encode($response); exit();}

		Horariotrabajador::where('id','=', $idhorariotrabajadores)->update([$request['accion'] => $request['check']]);

		echo json_encode($response);
	}


	public function actionAjaxSelectHorarioTrabajador(Request $request)
	{

		$idhorariotrabajadores 		=  	$request['idhorariotrabajador'];
		$idhorariotrabajadores 		= 	$this->funciones->decodificar($idhorariotrabajadores);
		$horario_id 				=  	$request['horario_id'];
		$hdia 						=  	'h'.$request['atributo']; //hlu.
		$rhdia 						=  	'rh'.$request['atributo']; //rhlu.
		$diacantmarc 				=  	$request['atributo'].'cantmarc'; //lucantmarc.
		$dia 						= 	$request['atributo'].'d';

		$horario            		=   Horario::where('id','=',$horario_id)->first();
		$hora 						= 	$horario->horainicio.' - '.$horario->horafin;

		$response 					= 	$this->funciones->getDiaAnterior($idhorariotrabajadores,$dia);
		if($response[0]['error']){echo json_encode($response); exit();}


		Horariotrabajador::where('id','=', $idhorariotrabajadores)
						  	->update([
						  				$hdia 	=> $horario_id,
						  				$rhdia 	=> $hora
						  		  ]);

		Asistenciatrabajador::where('horariotrabajador_id','=', $idhorariotrabajadores)
							->update([
										$hdia => $horario_id,
										$diacantmarc => $horario->marcacion
									]);



		$exito[] = array(
			'error'           		=> false,
			'mensaje'      			=> 'Realizado con exito',
			'hora'      			=> $hora
		);	

		echo json_encode($exito);

	}


	public function actionAjaxClonarHorario(Request $request)
	{

		$idsemana 				=  	$request['idsemana'];
		$idsemana 				= 	$this->funciones->decodificarmaestra($idsemana);		

		Horariotrabajadoresclonado::where('activo','=','1')->delete();

		$horariotrabajador 		= 	Horariotrabajador::all('id','luh','lud','hlu','rhlu','mah','mad','hma','rhma',
											'mih','mid','hmi','rhmi','juh','jud','hju','rhju',
											'vih','vid','hvi','rhvi','sah','sad','hsa','rhsa',
											'doh','dod','hdo','rhdo','activo','trabajador_id','semana_id','local_id')
									->where('semana_id','=',$idsemana)
									->toArray();

		DB::table('horariotrabajadoresclonados')->insert($horariotrabajador);

		$response[] = array(
							'error'           		=> true
		);

		echo json_encode($response);
	}

	public function actionAjaxCopiarHorarioClonado(Request $request)
	{


		$idsemana 					=  	$request['idsemana'];
		$idsemana 					= 	$this->funciones->decodificarmaestra($idsemana);		
		$listahorario 				= 	Horariotrabajador::where('semana_id','=',$idsemana)->orderBy('id', 'asc')->get();


		foreach($listahorario as $item){


			$listahorarioclonado 		= 	Horariotrabajadoresclonado::where('trabajador_id','=', $item->trabajador_id)->first();


			if(count($listahorarioclonado)>0){


				/************** HORARIO DEL TRABAJADOR ******************/

				$cabecera            	 	=	Horariotrabajador::find($item->id);

				$cabecera->luh 				= 	$listahorarioclonado->luh;
				$cabecera->hlu 				= 	$listahorarioclonado->hlu;
				$cabecera->rhlu 			= 	$listahorarioclonado->rhlu;

				$cabecera->mah 				= 	$listahorarioclonado->mah;
				$cabecera->hma 				= 	$listahorarioclonado->hma;
				$cabecera->rhma 			= 	$listahorarioclonado->rhma;

				$cabecera->mih 				= 	$listahorarioclonado->mih;
				$cabecera->hmi 				= 	$listahorarioclonado->hmi;
				$cabecera->rhmi 			= 	$listahorarioclonado->rhmi;	

				$cabecera->juh 				= 	$listahorarioclonado->juh;
				$cabecera->hju 				= 	$listahorarioclonado->hju;
				$cabecera->rhju 			= 	$listahorarioclonado->rhju;					

				$cabecera->vih 				= 	$listahorarioclonado->vih;
				$cabecera->hvi 				= 	$listahorarioclonado->hvi;
				$cabecera->rhvi 			= 	$listahorarioclonado->rhvi;					

				$cabecera->sah 				= 	$listahorarioclonado->sah;
				$cabecera->hsa 				= 	$listahorarioclonado->hsa;
				$cabecera->rhsa 			= 	$listahorarioclonado->rhsa;

				$cabecera->doh 				= 	$listahorarioclonado->doh;
				$cabecera->hdo 				= 	$listahorarioclonado->hdo;
				$cabecera->rhdo 			= 	$listahorarioclonado->rhdo;					
				$cabecera->save();



				/************** ASISTENCIA HORARIO DEL TRABAJADOR ******************/

				$cabeceras            		= 	Asistenciatrabajador::where('horariotrabajador_id', $item->id)->first();

				$horario            		=   Horario::where('id','=',$listahorarioclonado->hlu)->first();
			    $cabeceras->hlu 			=  	$horario->id; 
			    $cabeceras->lucantmarc 		=  	$horario->marcacion;

			    $horario            		=   Horario::where('id','=',$listahorarioclonado->hma)->first();
			    $cabeceras->hma 			=  	$horario->id;
			    $cabeceras->macantmarc 		=  	$horario->marcacion;

				$horario            		=   Horario::where('id','=',$listahorarioclonado->hmi)->first();
			    $cabeceras->hmi 			=  	$horario->id;
			    $cabeceras->micantmarc 		=  	$horario->marcacion;

				$horario            		=   Horario::where('id','=',$listahorarioclonado->hju)->first();
			    $cabeceras->hju 			=  	$horario->id;
			    $cabeceras->jucantmarc 		=  	$horario->marcacion;

				$horario            		=   Horario::where('id','=',$listahorarioclonado->hvi)->first();
			    $cabeceras->hvi 			=  	$horario->id;
			    $cabeceras->vicantmarc 		=  	$horario->marcacion;

				$horario            		=   Horario::where('id','=',$listahorarioclonado->hsa)->first();
			    $cabeceras->hsa 			=  	$horario->id;
			    $cabeceras->sacantmarc 		=  	$horario->marcacion;

				$horario            		=   Horario::where('id','=',$listahorarioclonado->hdo)->first();
			    $cabeceras->hdo 			=  	$horario->id;
			    $cabeceras->docantmarc 		=  	$horario->marcacion;	
				$cabeceras->save();	

			}
		}


		/*********** ACTUALIZAR EL AJAX DEL HORARIO ********/
		$horario 		= DB::table('horarios')->pluck('nombre','id')->toArray();
		$combohorario  	= $horario;

		$listahorario 	= Horariotrabajador::where('semana_id','=',$idsemana)->get();

		return View::make('horario/ajax/listahorariopersonal',
						 [
							 'listahorario'   => $listahorario,
							 'combohorario'   => $combohorario
						 ]);

	}

}
