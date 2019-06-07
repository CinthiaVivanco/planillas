<?php
namespace App\Biblioteca;

use DB,Hashids,Session,Redirect,table;
use App\RolOpcion,App\Local,App\Empresa,App\Horariotrabajador;

class Funcion{


	public function getUrl($idopcion,$acion) {

	  	//decodificar variable
	  	$decidopcion = Hashids::decode($idopcion);
	  	//ver si viene con letras la cadena codificada
	  	if(count($decidopcion)==0){ 
	  		return Redirect::back()->withInput()->with('errorurl', 'Indices de la url con errores'); 
	  	}

	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($decidopcion[0], 12, "0", STR_PAD_LEFT); 
	  	//concatenar prefijo

	  	// hemos hecho eso porque ahora el prefijo va hacer fijo en todas las empresas que PRMAECEN
		//$prefijo = Local::where('activo', '=', 1)->first();
		//$idopcioncompleta = $prefijo->prefijoLocal.$idopcioncompleta;
		$idopcioncompleta = 'PRMAECEN'.$idopcioncompleta;

	  	// ver si la opcion existe
	  	$opcion =  RolOpcion::where('opcion_id', '=',$idopcioncompleta)
	  			   ->where('rol_id', '=',Session::get('usuario')->rol_id)
	  			   ->where($acion, '=',1)
	  			   ->first();

	  	if(count($opcion)<=0){
	  		return Redirect::back()->withInput()->with('errorurl', 'No tiene autorización para '.$acion.' aquí');
	  	}
	  	return 'true';

	 }

	public function decodificar($id) {

	  	//decodificar variable
	  	$iddeco = Hashids::decode($id);
	  	//ver si viene con letras la cadena codificada
	  	if(count($iddeco)==0){ 
	  		return ''; 
	  	}

	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($iddeco[0], 12, "0", STR_PAD_LEFT); 
	  	//concatenar prefijo

		//$prefijo = Local::where('activo', '=', 1)->first();

		// apunta ahi en tu cuaderno porque esto solo va a permitir decodifcar  cuando sea el contrato del locl en donde estas del resto no 
		//¿cuando sea el contrato del local?
		$prefijo = Session::get('local')->prefijoLocal;
		$idopcioncompleta = $prefijo.$idopcioncompleta;
	  	
	  	return $idopcioncompleta;

	}

	public function decodificarmaestra($id) {

	  	//decodificar variable
	  	$iddeco = Hashids::decode($id);
	  	//ver si viene con letras la cadena codificada
	  	if(count($iddeco)==0){ 
	  		return ''; 
	  	}
	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($iddeco[0], 12, "0", STR_PAD_LEFT); 
	  	//concatenar prefijo

		//$prefijo = Local::where('activo', '=', 1)->first();

		// apunta ahi en tu cuaderno porque esto solo va a permitir decodifcar  cuando sea el contrato del locl en donde estas del resto no 
		//¿cuando sea el contrato del local?
		$prefijo = 'PRMAECEN';
		$idopcioncompleta = $prefijo.$idopcioncompleta;
	  	return $idopcioncompleta;

	}

	public function idmaestra() {

		$prefijo = 'PRMAECEN';
	  	return $prefijo;
	}

	public function getCreateId($tabla) {

  		$id="";


  		// maximo valor de la tabla referente
		$id = DB::table($tabla)
        ->select(DB::raw('max(SUBSTRING(id,9,12)) as id'))
        ->where('local_id','=', Session::get('local')->id)
        ->get();

        //conversion a string y suma uno para el siguiente id
        $idsuma = (int)$id[0]->id + 1;

	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($idsuma, 12, "0", STR_PAD_LEFT); 
	  	//concatenar prefijo
	  	// ahora el prefijo deberia venir del local que seleccionamos verdad ?si
		//$prefijo = Local::where('activo', '=', 1)->first()->prefijoLocal;
		$prefijo = Session::get('local')->prefijoLocal;

		$idopcioncompleta = $prefijo.$idopcioncompleta;

  		return $idopcioncompleta;	

	}

	public function getCreateIdMaestra($tabla) {

  		$id="";

  		// maximo valor de la tabla referente
		$id = DB::table($tabla)
        ->select(DB::raw('max(SUBSTRING(id,9,12)) as id'))
        ->get();

        //conversion a string y suma uno para el siguiente id
        $idsuma = (int)$id[0]->id + 1;

	  	//concatenar con ceros
	  	$idopcioncompleta = str_pad($idsuma, 12, "0", STR_PAD_LEFT);

	  	//concatenar prefijo
		$prefijo = 'PRMAECEN';

		$idopcioncompleta = $prefijo.$idopcioncompleta;

  		return $idopcioncompleta;	

	}


	public function getEmpresa() {

		$empresa 	= Empresa::where('activo','=', 1)->first();
  		return $empresa;	
	}

	
	public function getDiaAnterior($idhorariotrabajadores,$dia) {

		$mensaje					=   'Realizado con exito';
		$error						=   false;
		$fecha 						=   Horariotrabajador::where('id','=', $idhorariotrabajadores)
										->select($dia)->first();

		if($fecha->$dia < date('Y-m-d')){
			$mensaje = 'La fecha seleccionda es anterior a la fecha actual';
			$error   = true;
		}								

		$response[] = array(
			'error'           		=> $error,
			'mensaje'      			=> $mensaje
		);

		return $response;

	}


}

