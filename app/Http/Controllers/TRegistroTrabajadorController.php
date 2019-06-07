<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Trabajador,App\Estadocivil,App\Empresa,App\Local,App\Cargo,App\Horario,App\Paisemisordocumento,App\Contrato;
use App\Detallejornadalaboral,App\Convenio,App\Situacioneducativa,App\Institucion,App\Carrera,App\Categoria,App\Derechohabiente,App\Codigoeps; 
use View;
use ZipArchive;
use Session;
use Hashids;

class TRegistroTrabajadorController extends Controller
{

	public function actionTRegistro($idopcion){


		$listatrabajadores     			= Trabajador::get();
		//$listaderechohabiente 		= Derechohabiente::get();
		
		return View::make('trabajador/tregistro',
						 [
						 	'idopcion' 			 	 => $idopcion,
						 	'listatrabajadores' 	 => $listatrabajadores,
						 	//'listaderechohabiente' 	 => $listaderechohabiente,
						 ]);
 	}

	public function actionExportarTRegistro($idopcion,Request $request)
	{

		//$trabajador 				 = Trabajador::where('id', $idtrabajador)->first();
		
		$listatrabajadores			= 	Trabajador::whereIn('id',$request['trabajadores'])->get();

		$plame 						= 	$request['plame'];
		$fecha 						= 	date_format(date_create(date('Y-m-d')), 'd-m-Y');
		$se4  = false;
		$se5  = false;
		$se11 = false;
		$se17 = false;
		$se29 = false;		
		$se30 = false;						

		///////////////////////////////////////// E4 /////////////////////////////////////////////
		if (in_array('e4', $plame)) {

			$re4 = 'tregistro/txt/RP_20601265011.ide';
			//unlink($re4);			
			$fe4=fopen($re4,"w");

			foreach($listatrabajadores as $item){

				$paisemisor="";
				$nacionalidad="";
				$codtelefono="";
				$fechafin="";
				$regimensalud="";
				$numerovia="";

				/************************* PAIS EMISOR ****************************/ 

				if($item->paisemisordocumento_id == "" or $item->paisemisordocumento_id == Null){
					$paisemisor="604";
				}else{
					$paisemisor=$item->paisemisordocumento->codigo;
				}

				/************************* NACIONALIDAD ****************************/ 
				if($item->nacionalidad_id == "" or $item->nacionalidad_id == Null){
					$nacionalidad="9589";
				}else{
					$nacionalidad=$item->nacionalidad->codigo;
				}


				/*********************** CÓDIGO TELEFONO **************************/
				if($item->codigotelefono_id == "" or $item->codigotelefono_id == Null){
					$codtelefono="";
				}else{
					$codtelefono=$item->codigotelefono->codigo;
				}

				/*********************** NÚMERO VIA **************************/
				if ($item->numerovia == "" or $item->numerovia == Null) {
					$numerovia="";
					$nombrevia= $item->nombrevia;
				}else{
					$numerovia=$item->numerovia;
					$nombrevia= $item->nombrevia;
				}

				/*********************** REGIMEN SALUD *************************
				if($item->regimensalud->codigo  == 00 or $item->regimensalud->codigo  == 01 or $item->regimensalud->codigo  == 02 or $item->regimensalud->codigo  == 03 or $item->regimensalud->codigo  == 04){
					$regimensalud="";
				}else{
					$regimensalud=$item->codigotelefono->codigo;
				}
				*/
			
				/************************* Archivo txt ****************************/
				$fila = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.date_format(date_create($item->fechanacimiento),'d/m/Y').'|'.$item->apellidopaterno.'|'.$item->apellidomaterno.'|'.$item->nombres.'|'.$item->sexo.'|'.$nacionalidad.'|'.$codtelefono.'|'.$item->telefono.'|'.$item->email.'|'.$item->tipovia->codigo.'|'.$nombrevia.'|'.$numerovia.'|'.$item->provincia->codigo.'|'.$item->interior.'|'.$item->manzana.'|'.$item->lote.'|'.$item->kilometro.'|'.$item->bloque.'|'.$item->etapa.'|'.$item->tipozona->codigo.'|'.$item->nombrezona.'|'.$item->referencia.'|'.$item->distrito->codigo.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.''.'|'.'1'.'|';

				fwrite($fe4, $fila. PHP_EOL); 

			}

			fclose($fe4);

			$se4 = true;
		}



		///////////////////////////////////////// E5 /////////////////////////////////////////////

		if (in_array('e5', $plame)) {

			$re5 = 'tregistro/txt/RP_20601265011.tra'; 
			//unlink($re5);			
			$fe5=fopen($re5,"w");

			foreach($listatrabajadores as $item){

				$discapacidad 			="";
				$situacionespecial  	="";
				$categoriaocupacional 	="";
				$convenio 				="";
				$ocupacion 				="";
				$sindicalizado          ="";
				$tipopago   			="";
				$periodicidad  			="";
				$ruc 			 		="";
				$situacioneducativa 	="";
				$quintaexonerada 		="";
				$tiporegistro1 			="1";
				$tiporegistro2 			="2";
				$indicadortiporegistro1 ="";
				$indicadortiporegistro2 ="";
				$sctrpensiones 			="";

				/************************* CONTRATO ****************************/

				$contrato = Contrato::where('trabajador_id','=',$item->id)->where('estado','=','1')->first();

				if(count($contrato)>0){

					$maxima			= '';
					$atipica		= '';
					$nocturna		= '';
					$paisemisor 	= '';
					$sctrpensiones 	="";
				
				/***************************** PAIS EMISOR ****************************/ 

					if($item->paisemisordocumento_id == "" or $item->paisemisordocumento_id == Null){
						$paisemisor="604";
					}else{
						$paisemisor=$item->paisemisordocumento->codigo;
					}

					/************************* JORNADA LABORAL ****************************/ 
					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 71 or $item->tipotrabajador->codigo == 88 or $item->tipotrabajador->codigo == 98){

						$maxima			= '';
						$atipica		= '';
						$nocturna		= '';

					}else{

						$maxima = Detallejornadalaboral::where('contrato_id','=',$contrato->id)->where('jornadalaboral_id','=',$this->prefijomaestro.'000000000001')->first()->activo;
						$atipica = Detallejornadalaboral::where('contrato_id','=',$contrato->id)->where('jornadalaboral_id','=',$this->prefijomaestro.'000000000002')->first()->activo;
						$nocturna = Detallejornadalaboral::where('contrato_id','=',$contrato->id)->where('jornadalaboral_id','=',$this->prefijomaestro.'000000000003')->first()->activo;	

					}

					/************************* TIPO TRABAJADOR - DISCAPACIDAD ****************************/ 

					if($item->tipotrabajador->codigo == 66){

						$discapacidad  = "";
					}else{

						$discapacidad =$item->discapacidad;

					}

					/*********************** SITUACION EDUCATIVA **************************/

					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 71){

						$situacioneducativa="";

					}else{
						$situacioneducativa=$item->situacioneducativa->codigo;
					}

					/*********************** QUINTA EXONERADA**************************/

					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 67 or $item->tipotrabajador->codigo == 71){

						$quintaexonerada="";

					}else{
						$quintaexonerada=$item->quintaexonerada;
					}

					/*********************** SITUACIÓN ESPECIAL  **************************/

					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66  or $item->tipotrabajador->codigo == 71){

						$situacionespecial="";

					}else{
						$situacionespecial=$item->situacionespecial->codigo;
					}

					/*********************** CATEGORIA OCUPACIONAL  **************************/

					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 71 or $item->tipotrabajador->codigo == 73 or $item->tipotrabajador->codigo == 88 or $item->tipotrabajador->codigo == 89 or $item->tipotrabajador->codigo == 90 or $item->tipotrabajador->codigo == 91 or $item->tipotrabajador->codigo == 98){

						$categoriaocupacional="";

					}else{
						$categoriaocupacional=$item->categoriaocupacional->codigo;
					}


					/*********************** CONVENIO  **************************/

					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 71){

						$convenio="";

					}else{
						$convenio=$item->convenio->codigo;
					}

					/*********************** OCUPACIÓN  **************************/

					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 71 or $item->tipotrabajador->codigo == 73){

						$ocupacion="";

					}else{
						$ocupacion=$item->ocupacion->codigo;
					}

					/*********************** SINDICALIZADO  **************************/

					if($item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 73 or $item->tipotrabajador->codigo == 88 or $item->tipotrabajador->codigo == 98){

						$sindicalizado="";

					}else{
						$sindicalizado=$item->sindicalizado;
					}

					/*********************** PERIODICIDAD  **************************/

					if($item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 73 or $item->tipotrabajador->codigo == 88 or $item->tipotrabajador->codigo == 98){

						$periodicidad="";

					}else{
						$periodicidad=$contrato->periodicidad->codigo;
					}

					/*********************** TIPO PAGO  **************************/

					if($item->tipotrabajador->codigo == 23 or $item->tipotrabajador->codigo == 66 or $item->tipotrabajador->codigo == 71 or $item->tipotrabajador->codigo == 88 or $item->tipotrabajador->codigo == 98){

						$tipopago="";

					}else{
						$tipopago=$contrato->tipopago->codigo;
					}

					/*********************** RUC  **************************/
					 if($item->tipotrabajador->codigo == 67){
					  	$ruc="";
					 }			

					 /*********************** SCTRPENSIONES  **************************/
					 if($item->$sctrpensiones == "" or $item->$sctrpensiones == Null){
					  	$sctrpensiones="";
					 }else{
					 	$sctrpensiones=$item->$sctrpensiones;
					 }		

		
					/************************* Archivo txt *******************************/

					$fila = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$item->regimenlaboral->codigo.'|'.$situacioneducativa.'|'.$ocupacion.'|'.$discapacidad.'|'.$item->cussp.'|'.$sctrpensiones.'|'.$contrato->tipocontrato->codigo.'|'.$atipica.'|'.$maxima.'|'.$nocturna.'|'.$sindicalizado.'|'.$periodicidad.'|'.$contrato->remuneracion.'|'.$item->situacion->codigo.'|'.$quintaexonerada.'|'.$situacionespecial.'|'.$tipopago.'|'.$categoriaocupacional.'|'.$convenio.'|'.$ruc.'|';

					fwrite($fe5, $fila. PHP_EOL);
				}
			}


			fclose($fe5);
			$se5 = true;			

		}

		///////////////////////////////////////// E11 /////////////////////////////////////////////	

		if (in_array('e11', $plame)) {

			$re11 = 'tregistro/txt/RP_20601265011.per';
			//unlink($re11);			
			$fe11=fopen($re11,"w");
			$fechafin="";

				foreach($listatrabajadores as $item){

					$fechafin 			 	= '';
					$tiporegistro1 			="1";
					$tiporegistro2 			="2";
					$tiporegistro3 			="3";
					$tiporegistro4 			="4";
					$tiporegistro5 			="5";
					$indicadortiporegistro1 ="";
					$indicadortiporegistro2 ="";
					$indicadortiporegistro3 ="";
					$indicadortiporegistro4 ="";
					$indicadortiporegistro5 ="";
					$codigoeps  			="";

					/************************* CONTRATO ****************************/
					$contrato = Contrato::where('trabajador_id','=',$item->id)->where('estado','=','1')->first();

					if(count($contrato)>0){

						$paisemisor 	= '';
						$fechafin 		= '';

						/************************* PAIS EMISOR ****************************/ 

						if($item->paisemisordocumento == "" or $item->paisemisordocumento == Null){
							$paisemisor="604";
						}else{
							$paisemisor=$item->paisemisordocumento->codigo;
						}


						/************************* TIPO REGISTRO ****************************/ 

						if($tiporegistro1 == "1"){
							$indicadortiporegistro1="";
						}

						if($tiporegistro2 == "2"){
							$indicadortiporegistro2=$item->tipotrabajador->codigo;
						}

						if($tiporegistro3 == "3"){
							$indicadortiporegistro3=$item->regimensalud->codigo;
							$codigoeps=$item->codigoeps->codigo;

						}

						if($tiporegistro4 == "4"){
							$indicadortiporegistro4=$item->regimenpensionario->numero;

						}

						if($tiporegistro5 == "5"){
							$indicadortiporegistro5=$item->sctrsalud;

						}

						/*************************  EPS/Servicios Propios  ****************************/ 

						if($item->regimensalud->codigo == 01 or $item->regimensalud->codigo == 03){
							$codigoeps=$item->codigoeps->codigo;
						}else{
							$codigoeps="";
						}

						/************************* Archivo txt 1 - PERIODO ****************************/

						$fila1 = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$item->categoria->codigo.'|'.$tiporegistro1.'|'.date_format(date_create($contrato->fechainicio),'d/m/Y').'|'.''.'|'.$indicadortiporegistro1.'|'.$indicadortiporegistro1.'|';


						/************************* Archivo txt 2 - TIPO TRABAJADOR****************************/

						$fila2 = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$item->categoria->codigo.'|'.$tiporegistro2.'|'.date_format(date_create($contrato->fechainicio),'d/m/Y').'|'.''.'|'.$item->tipotrabajador->codigo.'|'.''.'|';

						/************************* Archivo txt 3 - REG ASEG SALUD****************************/

						$fila3 = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$item->categoria->codigo.'|'.$tiporegistro3.'|'.date_format(date_create($contrato->fechainicio),'d/m/Y').'|'.''.'|'.$indicadortiporegistro3.'|'.$codigoeps.'|';

						/************************* Archivo txt 4 - REGIMEN PENSIONARIO****************************/

						$fila4 = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$item->categoria->codigo.'|'.$tiporegistro4.'|'.date_format(date_create($contrato->fechainicio),'d/m/Y').'|'.''.'|'.$indicadortiporegistro4.'|'.''.'|';

						/************************* Archivo txt 5 - SCTRSALUD****************************/

						$fila5 = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$item->categoria->codigo.'|'.$tiporegistro5.'|'.date_format(date_create($contrato->fechainicio),'d/m/Y').'|'.''.'|'.$indicadortiporegistro5.'|'.''.'|';


						fwrite($fe11, $fila1. PHP_EOL);
						fwrite($fe11, $fila2. PHP_EOL);
						fwrite($fe11, $fila3. PHP_EOL);
						fwrite($fe11, $fila4. PHP_EOL);
						fwrite($fe11, $fila5. PHP_EOL);
					}
			}

			fclose($fe11);
			$se11 = true;			

		}

		///////////////////////////////////////// E17 /////////////////////////////////////////////		

		if (in_array('e17', $plame)) {

			$re17 = 'tregistro/txt/RP_20601265011.est';
			//unlink($re17);			
			$fe17=fopen($re17,"w");

			foreach($listatrabajadores as $item){

					/************************* CONTRATO ****************************/
					$contrato = Contrato::where('trabajador_id','=',$item->id)->where('estado','=','1')->first();

					if(count($contrato)>0){

						$paisemisor 	= '';
						$ruc 			= '';

						/************************* PAIS EMISOR ****************************/ 

						if($item->paisemisordocumento_id == "" or $item->paisemisordocumento_id == Null){
							$paisemisor="604";
						}else{
							$paisemisor=$item->paisemisordocumento->codigo;
						}

						/*********************** RUC  **************************/
						 if($item->tipotrabajador->codigo == 67){

						  	$ruc="";

						 }else{

						 	// para no hacerce problema hacemos esto 
						 	$ruc = Empresa::where('id','=',$item->local->empresa_id)->first()->ruc;

						 }

						/************************* Archivo txt *************************** .$item->local->empresa->ruc.'|'.$item->local->codigo.'|'  */

						$fila = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$ruc.'|'.$item->local->codigo.'|';

						fwrite($fe17, $fila. PHP_EOL);
					}
			}

			fclose($fe17);
			$se17 = true;			

		}

		///////////////////////////////////////// E29 /////////////////////////////////////////////		

		if (in_array('e29', $plame)) {

			$re29 = 'tregistro/txt/RP_20601265011.edu';
			//unlink($re29);			
			$fe29=fopen($re29,"w");
			$sw29= false;

			foreach($listatrabajadores as $item){

				$codigo3 = array("13","14", "15", "16", "17","18", "19", "20", "21","11"); 
				if (in_array($item->situacioneducativa->codigo, $codigo3)) {
		
				$estudiosperu="";
				$institucion="";
				$carrera="";
				$anioegreso="";

					/************************* CONTRATO ****************************/
					$contrato = Contrato::where('trabajador_id','=',$item->id)->where('estado','=','1')->first();

					if(count($contrato)>0){

						$paisemisor 	= '';
						$estudiosperu	="";

						/************************* PAIS EMISOR ***********************************/ 

						if($item->paisemisordocumento_id == "" or $item->paisemisordocumento_id == Null){
							$paisemisor="604";
						}else{
							$paisemisor=$item->paisemisordocumento->codigo;
						}

						/************************* SITUACIÓN EDUCATIVA ****************************/ 
						if($item->situacioneducativa->codigo == 11){ 
							$situacioneducativa=$item->situacioneducativa->codigo;
							$institucion=$item->institucion->codigo;
							$carrera=$item->carrera->codigo;
							$anioegreso=$item->anioegreso;
							$estudiosperu=$item->estudiosperu;
						}else{
							$situacioneducativa="13";
							$institucion=$item->institucion->codigo;
							$carrera=$item->carrera->codigo;
							$anioegreso=$item->anioegreso;
							$estudiosperu=$item->estudiosperu;					
						}

						/************************* ESTUDIOS PERÚ ****************************/ 

						if($item->estudiosperu == "" or $item->estudiosperu == Null){
							$estudiosperu="";
						}

						if($item->estudiosperu == 0){
							$estudiosperu=$item->estudiosperu;
							$institucion="";
							$carrera="";
							$anioegreso="";

						}

						/************************* INSTITUCIÓN ****************************/ 

						if($item->institucion_id == "" or $item->institucion_id == Null){
							$institucion="";
						}else{
							$institucion=$item->institucion->codigo;
						}

						/************************* CARRERA ****************************/ 

						if($item->carrera_id == "" or $item->carrera_id == Null){
							$carrera="";
						}else{
							$carrera=$item->carrera->codigo;
						}

						/************************* ANIO EGRESO ****************************/ 

						if($item->anioegreso == "" or $item->anioegreso == Null){
							$anioegreso="";
						}else{
							$anioegreso=$item->anioegreso;
						}

						/************************* Archivo txt ****************************/

						$fila = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$situacioneducativa.'|'.$estudiosperu.'|'.$institucion.'|'.$carrera.'|'.$anioegreso.'|';

						fwrite($fe29, $fila. PHP_EOL);
					}
					
				}	
			}
			fclose($fe29);
			$se29 = true;			
		}


		///////////////////////////////////////// E30 /////////////////////////////////////////////		

		if (in_array('e30', $plame)) {

			$re30 = 'tregistro/txt/RP_20601265011.cta';
			//unlink($re4);			
			$fe30=fopen($re30,"w");

			foreach($listatrabajadores as $item){

				/************************* CONTRATO ****************************/
					$contrato = Contrato::where('trabajador_id','=',$item->id)->where('estado','=','1')->first();

					if(count($contrato)>0){

						$paisemisor 	= '';


						/************************* PAIS EMISOR ****************************/ 

						if($item->paisemisordocumento == "" or $item->paisemisordocumento == Null){
							$paisemisor="604";
						}else{
							$paisemisor=$item->paisemisordocumento->codigo;
						}

					
			
				/************************* Archivo txt ****************************/
						$fila = $item->tipodocumento->identificador.'|'.$item->dni.'|'.$paisemisor.'|'.$item->entidadfinanciera->codigo.'|'.$contrato->numerocuenta.'|';

						fwrite($fe30, $fila. PHP_EOL); 
					}
			}
				$sw30 = true;

			fclose($fe30);
			$se30 = true;
		}

		// Descargar archivos txt.
		$zip = new ZipArchive(); 
		$filename = 'tregistro/zip/'.$fecha.'.zip'; 
		if($zip->open($filename,ZIPARCHIVE::CREATE)===true) { 

				if($se4){$zip->addFile($re4,'RP_20601265011.ide');}
				if($se5){$zip->addFile($re5,'RP_20601265011.tra');}
				if($se11){$zip->addFile($re11,'RP_20601265011.per');}
				if($se17){$zip->addFile($re17,'RP_20601265011.est');}
				if($se29){$zip->addFile($re29,'RP_20601265011.edu');}
				if($se30 and $sw30){$zip->addFile($re30,'RP_20601265011.cta');}
		        $zip->close();
		        
		} 
		else{ 
		    print_r("error descargar archivos");
		} 

		$enlace = $filename; 
		header ("Content-Disposition: attachment; filename=".$enlace); 
		header ("Content-Type: application/octet-stream"); 
		header ("Content-Length: ".filesize($enlace)); 
		readfile($enlace);

	}
}
