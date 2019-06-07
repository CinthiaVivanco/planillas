<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Rubro,App\Trabajador,App\Rubrotrabajador;
use View;
use Session;
use Hashids;
use PDF;
use Response;


class RubroController extends Controller
{

	public function actionTrabajadorxRubro($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $listatrabajadores = Trabajador::where('activo','=', 1)->get();

		return View::make('rubro/trabajadorxrubro',
						 [
						 	'listatrabajadores' => $listatrabajadores,
						 	'idopcion' => $idopcion,
						 ]);
	}

	public function actionListadetrabajadoresjson()
	{

		$listatrabajadores =  Trabajador::select(DB::raw("id as value, apellidopaterno + ' ' + apellidomaterno + ' ' + nombres  as text"))
							  ->get()->toArray();

		return response()->json($listatrabajadores);

	}

	public function actionAjaxListadoRubroxTrabajadores(Request $request)
	{

		$idtrabajador 			=  	$request['idtrabajador'];
		$listarubros 			= 	Rubrotrabajador::where('trabajador_id','=',$idtrabajador)
								  	->get();

		return View::make('rubro/ajax/listarubros',
						 [
							 'listarubros'   => $listarubros,
						 ]);

	}

	public function actionRubroxTrabajador($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $listarubros = Rubro::where('activo','=', 1)->get();

		return View::make('rubro/rubroxtrabajador',
						 [
						 	'listarubros' => $listarubros,
						 	'idopcion' => $idopcion,
						 ]);
	}

	public function actionAjaxListadoTrabajadoresxRubro(Request $request)
	{
		$idrubro 				=  	$request['idrubro'];
		$listatrabajadores 		= 	Rubrotrabajador::where('rubro_id','=',$idrubro)
								  	->get();

		return View::make('rubro/ajax/listatrabajadores',
						 [
							 'listatrabajadores'   => $listatrabajadores,
						 ]);
	}

	public function actionAjaxMontoTrabajadoresxRubro(Request $request)
	{

		$monto 							=  $request['monto'];
		$idrubrotrabajador 				=  $request['idrubrotrabajador'];		

		$cabecera            	 		=  Rubrotrabajador::find($idrubrotrabajador);
		$cabecera->monto 	     		=  $monto;				
		$cabecera->save();

		$response[] = array(
							'error'     => true
		);
		echo json_encode($response);

	}
	

	public function actionListaderubrosjson()
	{
		$listarubros =  Rubro::select(DB::raw('id as value,descripcion as text'))
						->get()->toArray();

		return response()->json($listarubros);
	}


	public function actionAjaxActualizarRubroTrabajador(Request $request)
	{

		$idrubro 				= $request['idrubro'];
		$listatrabajadores 		= Trabajador::where('activo','=',1)->get();
		$rubro 					= Rubro::where('id','=',$idrubro)->first();

		foreach($listatrabajadores as $item){

			$rubrotrabajador 		= 	Rubrotrabajador::where('trabajador_id','=',$item->id)
										->where('rubro_id','=',$rubro->id)
									  	->first();
			
			if(count($rubrotrabajador)<=0){

				$idrubrotrabajador 		= $this->funciones->getCreateIdMaestra('rubrotrabajadores');

				$cabecera            	 =	new Rubrotrabajador;
				$cabecera->id 	     	 =  $idrubrotrabajador;
				$cabecera->monto 	     =  $rubro->monto;
				$cabecera->rubro_id 	 =  $rubro->id;
				$cabecera->trabajador_id =  $item->id;
				$cabecera->IdUsuarioCrea =  Session::get('usuario')->id;											
				$cabecera->FechaCrea 	 =  $this->fechaActual;
				$cabecera->save();

			}else{

				$rubrotrabajador->monto 	     		=  $rubro->monto;
				$rubrotrabajador->IdUsuarioModifica 	=  Session::get('usuario')->id;											
				$rubrotrabajador->FechaModifica 	 	=  $this->fechaActual;
				$rubrotrabajador->save();

			}
		}

		$response[] = array(
							'error'           		=> true
		);
		echo json_encode($response);
	}

	public function actionListarRubros($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $listarubros = Rubro::orderBy('tiporubro_id', 'asc')->get();

		return View::make('rubro/listarubros',
						 [
						 	'listarubros' => $listarubros,
						 	'idopcion' => $idopcion,
						 ]);
	}

	public function actionAgregarRubro($idopcion,Request $request)
	{
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Anadir');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'codigo' => 'unique:rubros',
			], [
            	'codigo.unique' => 'Rubro ya registrado',
        	]);
			/******************************/



			$idrubro 				 = $this->funciones->getCreateIdMaestra('rubros');

			$cabecera            	 =	new Rubro;
			$cabecera->id 	     	 =  $idrubro;
			$cabecera->codigo 	     =  $request['codigo'];
			$cabecera->descripcion 	 =  $request['descripcion'];
			$cabecera->tiporubro_id  =  $request['rubro_id'];
			$cabecera->monto 	     =  $request['monto'];
			$cabecera->porcentaje 	 =  $request['porcentaje'];
			$cabecera->codigortps 	 =  $request['codigortps'];
			$cabecera->IdUsuarioCrea =  Session::get('usuario')->id;											
			$cabecera->FechaCrea 	 =  $this->fechaActual;								
			$cabecera->save();

 			return Redirect::to('/modificar-rubro/'.$idopcion.'/'.Hashids::encode(substr($idrubro, -12)))->with('bienhecho', 'Rubro '.$request['codigo'].' registrado con exito');
		
		}else{

		
			$tiporubro 				 	 = DB::table('tiporubros')->pluck('nombre','id')->toArray();
			$combotiporubro  		 	 = array('' => "Seleccione Tipo Rubro") + $tiporubro;

			return View::make('rubro/agregarrubro',
						[
						  	'idopcion' 		 => $idopcion,
						  	'combotiporubro' => $combotiporubro
						]);

		}
	}

	public function actionModificarRubro($idopcion,$idrubro,Request $request)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Modificar');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $idrubro = $this->funciones->decodificarmaestra($idrubro);

		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'codigo' => 'unique:rubros,codigo,'.$idrubro.',id',
			], [
            	'codigo.unique' => 'Rubro ya registrado',
        	]);
			/******************************/

			$cabecera            	 		=  Rubro::find($idrubro);
			$cabecera->codigo 	     		=  $request['codigo'];
			$cabecera->descripcion 	 		=  $request['descripcion'];
			$cabecera->tiporubro_id  		=  $request['rubro_id'];
			$cabecera->monto 	     		=  $request['monto'];
			$cabecera->porcentaje 	 		=  $request['porcentaje'];
			$cabecera->codigortps 	 		=  $request['codigortps'];
			$cabecera->IdUsuarioModifica 	=  Session::get('usuario')->id;											
			$cabecera->FechaModifica 	 	=  $this->fechaActual;
			$cabecera->activo 	 			=  $request['activo'];					
			$cabecera->save();
 

 			return Redirect::to('/gestion-de-rubros/'.$idopcion)->with('bienhecho', 'Rubro '.$request['codigo'].' modificado con exito');
		

		}else{

		        $rubro 							= Rubro::where('id', $idrubro)->first();
				$tiporubro 						= DB::table('tiporubros')->pluck('nombre','id')->toArray();
				$combotiporubro  				= array($rubro->tiporubro_id => $rubro->tiporubro->nombre) + $tiporubro ;

				return View::make('rubro/modificarrubro',
							[
							  	'idopcion' 		 => $idopcion,
							  	'combotiporubro' => $combotiporubro,
							  	'rubro' 		 => $rubro,
							]);

		}
	}

}
