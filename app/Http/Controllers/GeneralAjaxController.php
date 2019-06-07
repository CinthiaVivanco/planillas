<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use View;
use Session;
use Hashids;


class GeneralAjaxController extends Controller
{
	public function actionProvinciaAjax(Request $request)
	{
		$departamento_id   = $request['departamentos_id'];

		$provincia = DB::table('provincias')->where('departamento_id','=',$departamento_id)->pluck('nombre','id')->toArray();
		$comboprovincia  = array(0 => "Seleccione Provincia") + $provincia;

		return View::make('general/ajax/comboprovincia',
						 [
						 'comboprovincia' => $comboprovincia
						
						 ]);
	}	

	public function actionDistritoAjax(Request $request)
	{
		$provincia_id   = $request['provincia_id'];

		$distrito = DB::table('distritos')->where('provincia_id','=',$provincia_id)->pluck('nombre','id')->toArray();
		$combodistrito  = array(0 => "Seleccione Distrito") + $distrito;

		return View::make('general/ajax/combodistrito',
						 [
						 'combodistrito' => $combodistrito

						 ]);
	}	

	public function actionLocalAjax(Request $request)
	{

		$empresa_id   = $request['empresa_id'];

		$local 		 = DB::table('locales')->where('empresa_id','=',$empresa_id)->pluck('nombreabreviado','id')->toArray();
		$combolocal  = array(0 => "Seleccione local") + $local;

		return View::make('general/ajax/combolocal',
						 [
						 'combolocal' => $combolocal

						 ]);
	}

	public function actionAreaAjax(Request $request)
	{
		$gerencia_id   = $request['gerencia_id'];

		$area = DB::table('areas')->where('gerencia_id','=',$gerencia_id)->pluck('nombre','id')->toArray();
		$comboarea  = array(0 => "Seleccione Área") + $area;

		return View::make('general/ajax/comboarea',
						 [
						 'comboarea' => $comboarea
						 ]);
	}	


	public function actionUnidadAjax(Request $request)
	{
		$area_id   = $request['area_id'];

		$unidad = DB::table('unidades')->where('area_id','=',$area_id)->pluck('nombre','id')->toArray();
		$combounidad  = array(0 => "Seleccione Unidad") + $unidad;

		return View::make('general/ajax/combounidad',
						 [
						 'combounidad' => $combounidad
						 ]);
	}	

	public function actionCargoAjax(Request $request)
	{
		$unidad_id   = $request['unidad_id'];

		$cargo = DB::table('cargos')->where('unidad_id','=',$unidad_id)->pluck('nombre','id')->toArray();
		$combocargo  = array(0 => "Seleccione Cargo") + $cargo;

		return View::make('general/ajax/combocargo',
						 [
						 'combocargo' => $combocargo
						 ]);
	}



	public function actionTipoDocumentoAcreditaAjax(Request $request)
	{
		$vinculofamiliar_id   = $request['vinculofamiliar_id'];

		$tipodocumentoacredita = DB::table('tipodocumentoacreditas')->where('vinculofamiliar_id','=',$vinculofamiliar_id)->pluck('descripcionabreviado','id')->toArray();
		$combotipodocumentoacredita  = array(0 => "Seleccione Tipo Doc Acredita") + $tipodocumentoacredita;

		return View::make('general/ajax/combotipodocumentoacredita',
						 [
						 'combotipodocumentoacredita' => $combotipodocumentoacredita

						 ]);
	}		


	public function actionTipoInstitucionAjax(Request $request)
	{
		$regimeninstitucion_id   = $request['regimeninstitucion_id'];

		$tipoinstitucion = DB::table('tipoinstituciones')->where('regimeninstitucion_id','=',$regimeninstitucion_id)->pluck('nombre','id')->toArray();
		$combotipoinstitucion  = array('' => "Seleccione Tipo Institucion") + $tipoinstitucion;

		return View::make('general/ajax/combotipoinstitucion',
						 [
						 'combotipoinstitucion' => $combotipoinstitucion
						 ]);
	}	


	public function actionInstitucionAjax(Request $request)
	{
		
		$tipoinstitucion_id   = $request['tipoinstitucion_id'];

		$institucion = DB::table('instituciones')->where('tipoinstitucion_id','=',$tipoinstitucion_id)->pluck('nombre','id')->toArray();
		$comboinstitucion = array('' => "Seleccione Institucion") + $institucion;

		return View::make('general/ajax/comboinstitucion',
						 [
						 'comboinstitucion' => $comboinstitucion
						 ]);
	}


	public function actionCarreraAjax(Request $request)
	{
		$institucion_id = $request['institucion_id'];

		$carrera 		= DB::table('carreras')->where('institucion_id','=',$institucion_id)->pluck('nombre','id')->toArray();
		$combocarrera   = array('' => "Seleccione Carrera") + $carrera;

		return View::make('general/ajax/combocarrera',
						 [
						 'combocarrera' => $combocarrera
						 ]);
	}	
}
