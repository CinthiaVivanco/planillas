<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Cargo,App\Cargoempresa,App\Empresa,App\Permisouserempresa;
use App\Dia,App\TipoDia,App\Periodo,App\Mes,App\Afp,App\Banco;
use View;
use ZipArchive;
use Session;
use Hashids;
use PDO;

class MantenimientoController extends Controller
{

	public function actionListarAfp($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $listarafp = Afp::orderBy('nombre', 'asc')->get();

		return View::make('mantenimiento/listarafp',
						 [
						 	'listarafp' => $listarafp,
						 	'idopcion' => $idopcion,
						 ]);
	}

	public function actionAgregarAfp($idopcion,Request $request)
	{
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Anadir');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'nombre' => 'unique:afps',
			], [
            	'nombre.unique' => 'Afp ya registrado',
        	]);
			/******************************/

			//////////////////  Afp  ///////////////////

					$idafp 				 	= $this->funciones->getCreateIdMaestra('afps');

					$cabecera            	 =	new Afp;
					$cabecera->id 	     	 =  $idafp;
					$cabecera->nombre 	     =  $request['nombre'];
					$cabecera->direccion 	 =  $request['direccion'];
					$cabecera->contacto 	 =  $request['contacto'];
					$cabecera->telefono1 	 =  $request['telefono1'];
					$cabecera->telefono2 	 =  $request['telefono2'];
					$cabecera->fondo 	     =  $request['fondo'];
					$cabecera->comision 	 =  $request['comision'];
					$cabecera->IdUsuarioCrea =  Session::get('usuario')->id;											
					$cabecera->FechaCrea 	 =  $this->fechaActual;
					$cabecera->seguro 	     =  $request['seguro'];

					$cabecera->save();

					////////////////////////////////////////////////////////////////////////

 			return Redirect::to('/gestion-de-afp/'.$idopcion)->with('bienhecho', 'Afp '.$request['nombre'].' registrado con éxito');

		}else{

			return View::make('mantenimiento/agregarafp',
						[
						  	'idopcion' 		 => $idopcion,
						]);
		}
	}


	public function actionModificarAfp($idopcion,$idafp,Request $request)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Modificar');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $idafp = $this->funciones->decodificarmaestra($idafp);

		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'nombre' => 'unique:afps,nombre,'.$idafp.',id',
			], [
            	'nombre.unique' => 'Afp ya registrado',
        	]);
			/******************************/
			$cabecera            	 		=  Afp::find($idafp);
			$cabecera->nombre 	     		=  $request['nombre'];
			$cabecera->direccion 	 		=  $request['direccion'];
			$cabecera->contacto  			=  $request['contacto'];
			$cabecera->telefono1 	     	=  $request['telefono1'];
			$cabecera->telefono2 	 		=  $request['telefono2'];
			$cabecera->fondo 	 			=  $request['fondo'];
			$cabecera->comision 	 		=  $request['comision'];
			$cabecera->seguro 	 			=  $request['seguro'];
			$cabecera->IdUsuarioModifica 	=  Session::get('usuario')->id;											
			$cabecera->FechaModifica 	 	=  $this->fechaActual;
			$cabecera->activo 	 			=  $request['activo'];					
			$cabecera->save();

 			return Redirect::to('/gestion-de-afp/'.$idopcion)->with('bienhecho', 'Afp '.$request['nombre'].' modificado con éxito');
	
		}else{

			$afp 							= Afp::where('id', $idafp)->first();

				return View::make('mantenimiento/modificarafp',
							[
							  	'idopcion' 		 => $idopcion,
							  	'afp' 			 => $afp,
							]);
		}
	}

	public function actionListarBancos($idopcion)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Ver');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $listarbanco = Banco::orderBy('nombre', 'asc')->get();

		return View::make('mantenimiento/listarbanco',
						 [
						 	'listarbanco' => $listarbanco,
						 	'idopcion' 	  => $idopcion,
						 ]);
	}

	public function actionAgregarBancos($idopcion,Request $request)
	{
		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Anadir');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'nombre' => 'unique:bancos',
			], [
            	'nombre.unique' => 'Banco ya registrado',
        	]);
			/******************************/

			//////////////////  Banco  ///////////////////

					$idbanco 				 	 = $this->funciones->getCreateIdMaestra('bancos');

					$cabecera            	 	 =	new Banco;
					$cabecera->id 	     	 	 =  $idbanco;
					$cabecera->nombre 	     	 =  $request['nombre'];
					$cabecera->contacto 	 	 =  $request['contacto'];
					$cabecera->cuentacorriente 	 =  $request['cuentacorriente'];
					$cabecera->IdUsuarioCrea 	 =  Session::get('usuario')->id;											
					$cabecera->FechaCrea 	 	 =  $this->fechaActual;

					$cabecera->save();

					////////////////////////////////////////////////////////////////////////

 			return Redirect::to('/gestion-de-bancos/'.$idopcion)->with('bienhecho', 'Banco '.$request['nombre'].' registrado con éxito');

		}else{

			return View::make('mantenimiento/agregarbanco',
						[
						  	'idopcion' 		 => $idopcion,
						]);
		}
	}


	public function actionModificarBancos($idopcion,$idbanco,Request $request)
	{

		/******************* validar url **********************/
		$validarurl = $this->funciones->getUrl($idopcion,'Modificar');
	    if($validarurl <> 'true'){return $validarurl;}
	    /******************************************************/

	    $idbanco = $this->funciones->decodificarmaestra($idbanco);

		if($_POST)
		{

			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'nombre' => 'unique:bancos,nombre,'.$idbanco.',id',
			], [
            	'nombre.unique' => 'Banco ya registrado',
        	]);
			/******************************/

			$cabecera            	 		=  Banco::find($idbanco);
			$cabecera->nombre 	     	 	=  $request['nombre'];
			$cabecera->contacto 	 	 	=  $request['contacto'];
			$cabecera->cuentacorriente 	 	=  $request['cuentacorriente'];
			$cabecera->IdUsuarioModifica 	=  Session::get('usuario')->id;											
			$cabecera->FechaModifica 	 	=  $this->fechaActual;
			$cabecera->activo 	 			=  $request['activo'];					
			$cabecera->save();

 			return Redirect::to('/gestion-de-bancos/'.$idopcion)->with('bienhecho', 'Bancos '.$request['nombre'].' modificado con éxito');
		

		}else{

			$banco 							= Banco::where('id', $idbanco)->first();

				return View::make('mantenimiento/modificarbanco',
							[
							  	'idopcion' 	=> $idopcion,
							  	'banco' 	=> $banco,
							]);

		}
	}

	
}
