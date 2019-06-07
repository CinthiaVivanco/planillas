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
use PDF;


class HorarioReporteController extends Controller
{

	public function actionHorarioSemanaPdf($idsemana)
	{

		$horario 		= 	Horario::all()->toArray();
		$titulo			= 	"Horario x Semana";
		$idsemana 		= 	$this->funciones->decodificarmaestra($idsemana);
		$listahorario 	= 	Horariotrabajador::where('semana_id','=',$idsemana)->get();

		$pdf 			= 	PDF::loadView('horario.pdf.horarioxsemana', 
											[ 
												'listahorario' 		  => $listahorario,
												'titulo' 		  	  => $titulo,
												'horario' 		  	  => $horario,												
											]);


		return $pdf->stream('download.pdf');



	}


}
