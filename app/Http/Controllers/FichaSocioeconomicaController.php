<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Trabajador,App\FichaSocioeconomica,App\Casaparte,App\Tipovivienda;
use App\Construccionmaterial,App\Centromedico,App\Frecuenciamedico,App\Frecuenciaexamen,App\Servicio,App\Enfermedad;
use App\Detallefichaservicio, App\Detallefichacasaparte, App\Detallefichaenfermedad;
use View;
use Session;
use Hashids;


class FichaSocioeconomicaController extends Controller
{


	public function actionModificarFichaSocioeconomica($idfichasocioeconomica,$idopcion,$idtrabajador,Request $request)
	{


			$cabecera            	 	 		 =	Fichasocioeconomica::find($idfichasocioeconomica);
			$cabecera->tipovivienda_id  		 = 	$request['tipovivienda_id'];
			$cabecera->otrotipovivienda  		 = 	$request['otrotipovivienda'];
			$cabecera->otromaterial  		 	 = 	$request['otromaterial'];
			$cabecera->otraenfermedad  		 	 = 	$request['otraenfermedad'];
			$cabecera->construccionmaterial_id 	 =  $request['construccionmaterial_id'];
			$cabecera->centromedico_id 	 		 = 	$request['centromedico_id'];
			$cabecera->frecuenciamedico_id  	 =	$request['frecuenciamedico_id'];
			$cabecera->frecuenciaexamen_id   	 = 	$request['frecuenciaexamen_id'];
			$cabecera->religion   			 	 = 	$request['religion'];
			$cabecera->gruposanguineo 		 	 = 	$request['gruposanguineo'];
			$cabecera->tallapantalon 		 	 =	$request['tallapantalon'];
			$cabecera->tallacamisa 		 		 =	$request['tallacamisa'];
			$cabecera->tallapolo 	 	 		 = 	$request['tallapolo'];
			$cabecera->tallazapato		 		 =	$request['tallazapato'];
			$cabecera->callesreferencia		 	 =	$request['callesreferencia'];
			$cabecera->telefonofijo 		 	 = 	$request['telefonofijo'];
			

			$cabecera->IdUsuarioModifica 		 = Session::get('usuario')->id;
			$cabecera->FechaModifica  		     = $this->fechaActual;

			$cabecera->telefonoemergencia 		 = 	$request['telefonoemergencia'];
			$cabecera->referenciafamiliar 		 = 	$request['referenciafamiliar'];
			$cabecera->ingresomensual 			 = 	$request['ingresomensual'];
			$cabecera->otroingreso 		 	     = 	$request['otroingreso'];
			$cabecera->negociopropio             = 	$request['negociopropio'];
			$cabecera->deudas 	 			     = 	$request['deudas'];
			$cabecera->estadoconstruccion 	 	 = 	$request['estadoconstruccion'];
			$cabecera->laboratorioclinico 	 	 = 	$request['laboratorioclinico'];
			$cabecera->observacion 	 	         = 	$request['observacion'];
			$cabecera->save();


			//////////// Llenamos Tabla DetalleFichaServicios ///////

			$servicios 								= $request['servicio']; // este es un array que nos devuelve todos los id seleccionados
			$listaservicio 							= Servicio::get(); //listamos todos los servicio
			foreach($listaservicio as $item){

				$activo 							= 0;
				if (in_array($item->id, $servicios)) {
				    $activo 						= 1;
				}

			    $detalle            				=	Detallefichaservicio::where('fichasocioeconomica_id','=',$idfichasocioeconomica)
			    										->where('servicio_id','=',$item->id)->first();
				$detalle->activo     				=  	$activo;
				$detalle->save();



			}


			//////////// Llenamos Tabla DetalleFichaCasaPartes ///////

			$casapartes 							= $request['casaparte']; // este es un array que nos devuelve todos los id seleccionados
			$listacasaparte 						= Casaparte::get(); //listamos todos los casapartes
			foreach($listacasaparte as $item){

				$activo 							= 0;
				if (in_array($item->id, $casapartes)) {
				    $activo 						= 1;
				}

			    $detalle            				=	Detallefichacasaparte::where('fichasocioeconomica_id','=',$idfichasocioeconomica)
			    										->where('casaparte_id','=',$item->id)->first();			    
				$detalle->activo     				=  	$activo;
				$detalle->save();


			}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//////////// Llenamos Tabla DetalleFichaEnfermedades ///////

			$enfermedades 							= $request['enfermedad']; // este es un array que nos devuelve todos los id seleccionados
			$listaenfermedad 						= Enfermedad::get(); //listamos todos los casapartes
			foreach($listaenfermedad as $item){

				$activo 							= 0;


				if (in_array($item->id, $enfermedades)) {
				    $activo 						= 1;
				}

			    $detalle            				=	Detallefichaenfermedad::where('fichasocioeconomica_id','=',$idfichasocioeconomica)
			    										->where('enfermedad_id','=',$item->id)->first();				    
				$detalle->activo     				=  	$activo;
				$detalle->save();

			}
			///////////////////////////////////////////////////////////



 			return Redirect::to('/ficha-socioeconomica-trabajador/'.$idopcion.'/'.$idtrabajador)->with('bienhecho', 'FichaSocioeconomica'.$request['nombre'].' '.$request['apellidopaterno'].' Modificado con éxito');
	}


	public function actionFichaSocioeconomica($idopcion,$idtrabajador,Request $request)
	{
		$idtrabajadorsd  = $idtrabajador;
	    $idtrabajador    = $this->funciones->decodificar($idtrabajador);

		if($_POST)
		{
			/**** Validaciones laravel ****/
			$this->validate($request, [
	            'id' => 'unique:fichasocioeconomicas',
			], [
            	'id.unique' => 'Ficha ya registrada',
        	]);
			/******************************/ 

			$idfichasocioeconomica 		 	     = $this->funciones->getCreateId('fichasocioeconomicas');
			
			$cabecera            	 	 		 =	new Fichasocioeconomica;
			$cabecera->id 	     	 	 		 =  $idfichasocioeconomica;

			$cabecera->tipovivienda_id  		 = 	$request['tipovivienda_id'];
			$cabecera->construccionmaterial_id 	 =  $request['construccionmaterial_id'];
			$cabecera->otrotipovivienda  		 = 	$request['otrotipovivienda'];
			$cabecera->otromaterial  		 	 = 	$request['otromaterial'];
			$cabecera->otraenfermedad  		 	 = 	$request['otraenfermedad'];
			$cabecera->centromedico_id 	 		 = 	$request['centromedico_id'];
			$cabecera->frecuenciamedico_id  	 =	$request['frecuenciamedico_id'];
			$cabecera->frecuenciaexamen_id   	 = 	$request['frecuenciaexamen_id'];
			$cabecera->religion   			 	 = 	$request['religion'];
			$cabecera->gruposanguineo 		 	 = 	$request['gruposanguineo'];
			$cabecera->tallapantalon 		 	 =	$request['tallapantalon'];
			$cabecera->tallacamisa 		 		 =	$request['tallacamisa'];
			$cabecera->tallapolo 	 	 		 = 	$request['tallapolo'];
			$cabecera->tallazapato		 		 =	$request['tallazapato'];
			$cabecera->callesreferencia		 	 =	$request['callesreferencia'];
			$cabecera->telefonofijo 		 	 = 	$request['telefonofijo'];
			$cabecera->telefonoemergencia 		 = 	$request['telefonoemergencia'];
			$cabecera->referenciafamiliar 		 = 	$request['referenciafamiliar'];
			$cabecera->ingresomensual 			 = 	$request['ingresomensual'];
			$cabecera->otroingreso 		 	     = 	$request['otroingreso'];
			$cabecera->negociopropio             = 	$request['negociopropio'];
			$cabecera->deudas 	 			     = 	$request['deudas'];
			$cabecera->estadoconstruccion 	 	 = 	$request['estadoconstruccion'];
			$cabecera->laboratorioclinico 	 	 = 	$request['laboratorioclinico'];
			$cabecera->observacion 	 	         = 	$request['observacion'];
			$cabecera->local_id 				 = 	Session::get('local')->id; 
			$cabecera->IdUsuarioCrea 			 = 	Session::get('usuario')->id;
			$cabecera->FechaCrea  		         = 	$this->fechaActual;
			$cabecera->trabajador_id 			 = 	$idtrabajador;

			$cabecera->save();


			//ok ya esta apunta en tu cuaderno que tenemos que ver esto de los id como lo vamos amanejar ok ?ok
			//////////// Llenamos Tabla DetalleFichaServicios ///////

			$servicios 								= $request['servicio']; // este es un array que nos devuelve todos los id seleccionados
			$listaservicio 							= Servicio::get(); //listamos todos los servicio
			foreach($listaservicio as $item){

				$activo 							= 0;
				$iddetallefichaservicios 			= $this->funciones->getCreateId('detallefichaservicios');

				if (in_array($item->id, $servicios)) {
				    $activo 						= 1;
				}

			    $detalle            				=	new Detallefichaservicio; 
			    $detalle->id 	    				=  	$iddetallefichaservicios;
				$detalle->fichasocioeconomica_id    = 	$idfichasocioeconomica;
				$detalle->servicio_id    			=  	$item->id;
				$detalle->local_id 				 	= 	Session::get('local')->id;				
				$detalle->activo     				=  	$activo;
				$detalle->save();

			}

			//////////// Llenamos Tabla DetalleFichaCasaPartes ///////

			$casapartes 							= $request['casaparte']; // este es un array que nos devuelve todos los id seleccionados
			$listacasaparte 						= Casaparte::get(); //listamos todos los casapartes
			foreach($listacasaparte as $item){

				$activo 							= 0;
				$iddetallefichacasapartes 			= $this->funciones->getCreateId('detallefichacasapartes');

				if (in_array($item->id, $casapartes)) {
				    $activo 						= 1;
				}

			    $detalle            				=	new Detallefichacasaparte;
			    $detalle->id 	    				=  	$iddetallefichacasapartes;
				$detalle->fichasocioeconomica_id    = 	$idfichasocioeconomica;
				$detalle->casaparte_id    			=  	$item->id;
				$detalle->local_id 				 	= 	Session::get('local')->id;
				$detalle->activo     				=  	$activo;
				$detalle->save();

			}


			//////////// Llenamos Tabla DetalleFichaEnfermedades ///////

			$enfermedades 							= $request['enfermedad']; // este es un array que nos devuelve todos los id seleccionados
			$listaenfermedad 						= Enfermedad::get(); //listamos todos los casapartes
			foreach($listaenfermedad as $item){
	
				$activo 							= 0;
				$iddetallefichaenfermedades 		= $this->funciones->getCreateId('detallefichaenfermedades');

				if (in_array($item->id, $enfermedades)) {
				    $activo 						= 1;
				}

			    $detalle            				=	new Detallefichaenfermedad;
			    $detalle->id 	    				=  	$iddetallefichaenfermedades;
				$detalle->fichasocioeconomica_id    = 	$idfichasocioeconomica;
				$detalle->enfermedad_id    			=  	$item->id;
				$detalle->local_id 					= 	Session::get('local')->id;
				$detalle->activo     				=  	$activo;
				$detalle->save();

			}
			///////////////////////////////////////////////////////////


 			return Redirect::to('/ficha-socioeconomica-trabajador/'.$idopcion.'/'.$idtrabajadorsd)->with('bienhecho', 'FichaSocioeconomica'.$request['nombre'].' '.$request['apellidopaterno'].' registrado con éxito');

 			

		}else{



			$fichasocioeconomica 			= Fichasocioeconomica::where('trabajador_id','=' , $idtrabajador)->first();
			
		    $trabajador 					= Trabajador::where('id', $idtrabajador)->first();		 
			$tipovivienda 				 	= Tipovivienda::get(); 
			$construccionmaterial 		    = Construccionmaterial::get(); 
			$centromedico 					= Centromedico::get(); 
			$frecuenciamedico 			    = Frecuenciamedico::get(); 
			$frecuenciaexamen 				= Frecuenciaexamen::get();

			if(count($fichasocioeconomica)>0){
				$casaparte 				        = Detallefichacasaparte::join('casapartes', 'detallefichacasapartes.casaparte_id', '=', 'casapartes.id')
											  		->select('casapartes.id','casapartes.descripcion','detallefichacasapartes.activo')
											  		->where('fichasocioeconomica_id','=',$fichasocioeconomica->id)->get();
				$servicio 					 	= Detallefichaservicio::join('servicios', 'detallefichaservicios.servicio_id', '=', 'servicios.id')
											  		->select('servicios.id','servicios.descripcion','detallefichaservicios.activo')
											  		->where('fichasocioeconomica_id','=',$fichasocioeconomica->id)->get(); 
				$enfermedad 					= Detallefichaenfermedad::join('enfermedades', 'detallefichaenfermedades.enfermedad_id', '=', 'enfermedades.id')
											  		->select('enfermedades.id','enfermedades.descripcion','detallefichaenfermedades.activo')
											  		->where('fichasocioeconomica_id','=',$fichasocioeconomica->id)->get();				
			}else{

				$casaparte 				        = Casaparte::get(); 
				$servicio 					 	= Servicio::get();
				$enfermedad 					= Enfermedad::get();

			}




	        return View::make('trabajador/fichasocioeconomicatrabajador', 
	        				[

	        					'fichasocioeconomica'  	    			=> $fichasocioeconomica,
	        					'trabajador'  	    					=> $trabajador,
	        					'idopcion'  	    					=> $idopcion,
	        					'tipovivienda'  	    				=> $tipovivienda,
	        					'casaparte'  	    					=> $casaparte,
	        					'construccionmaterial'  	    		=> $construccionmaterial,
	        					'servicio'  	    					=> $servicio,
	        					'centromedico' 							=> $centromedico,
	        					'frecuenciamedico' 						=> $frecuenciamedico,
						  		'frecuenciaexamen' 						=> $frecuenciaexamen,
						  		'enfermedad' 							=> $enfermedad,
						  		
	        				]);
		}
	}

	public function actionFichaSocioeconomicaAjax(Request $request)
	{

		$id   							= $request['id'];
		$idopcion   					= $request['idopcion'];
		$idtrabajador   				= $request['idtrabajador'];

		$fichasocioeconomica 		    = Fichasocioeconomica::where('id','=' , $id)->first();

		$tipovivienda 				 	= Tipovivienda::get(); 

		$casaparte 				        = Detallefichacasaparte::join('casapartes', 'detallefichacasapartes.casaparte_id', '=', 'casapartes.id')
										  ->select('casapartes.id','casapartes.descripcion','detallefichacasapartes.activo')
										  ->where('fichasocioeconomica_id','=',$id)->get();

		$construccionmaterial 		    = Construccionmaterial::get(); 

		$servicio 					 	= Detallefichaservicio::join('servicios', 'detallefichaservicios.servicio_id', '=', 'servicios.id')
										  ->select('servicios.id','servicios.descripcion','detallefichaservicios.activo')
										  ->where('fichasocioeconomica_id','=',$id)->get(); 

		$centromedico 					= Centromedico::get(); 

		$frecuenciamedico 			    = Frecuenciamedico::get(); 
		$frecuenciaexamen 				= Frecuenciaexamen::get();

		$enfermedad 					= Detallefichaenfermedad::join('enfermedades', 'detallefichaenfermedades.enfermedad_id', '=', 'enfermedades.id')
										  ->select('enfermedades.id','enfermedades.descripcion','detallefichaenfermedades.activo')
										  ->where('fichasocioeconomica_id','=',$id)->get();


		return View::make('trabajador/ajax/editfs',
						 [
	        					'id'  	    							=> $id,
	        					'idopcion'  	    					=> $idopcion,
	        					'idtrabajador'  	    				=> $idtrabajador,
	        					'tipovivienda'  	    				=> $tipovivienda,
	        					'casaparte'  	    					=> $casaparte,
	        					'construccionmaterial'  	    		=> $construccionmaterial,
	        					'servicio'  	    					=> $servicio,
	        					'centromedico' 							=> $centromedico,
	        					'frecuenciamedico' 						=> $frecuenciamedico,
						  		'frecuenciaexamen' 						=> $frecuenciaexamen,
						  		'enfermedad' 							=> $enfermedad,
						  		'fichasocioeconomica' 					=> $fichasocioeconomica,
						  		
						 ]);
	}	
}
