<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\User,App\Maestro,App\Ilog,App\Trabajador,App\Contrato;
use Mail;
use DB;

use DateTime;

class ContratosVencer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trabajador:contrato';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Contratos por vencer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $hoy                        =   date('Y-m-d');
        $mes                        =   strtotime ('+30 day', strtotime ($hoy));
        $mes                        =   date ('Y-m-d', $mes );
        $envio                      =   'No';


        $listacontratos             =   Contrato::join('Trabajadores', 'Trabajadores.id', '=', 'Contratos.trabajador_id')
                                        ->select(DB::raw('DATEDIFF(day,getdate(),Contratos.fechafin) as dias, Contratos.*,
                                                         Trabajadores.nombres,Trabajadores.apellidopaterno,Trabajadores.apellidomaterno'))
                                        ->where('Contratos.fechafin','>=',$hoy)
                                        ->where('Contratos.fechafin','<=',$mes)
                                        ->where('Contratos.estado','=',1)
                                        ->orderBy('Contratos.fechafin', 'asc')
                                        ->get()->toArray();

        $array                      =   array('array' => $listacontratos);                              



        if(count($listacontratos)>0){

            // correos from(de)
            $emailfrom = Maestro::where('codigoatributo','=','0002')->where('codigoestado','=','00001')->first();
            // correos principales y  copias
            $email     = Maestro::where('codigoatributo','=','0002')->where('codigoestado','=','00003')->first();


            Mail::send('emails.contratosporvencer', $array, function($message) use ($emailfrom,$email)
            {

                $emailprincipal     = explode(",", $email->correoprincipal);
                
                $message->from($emailfrom->correoprincipal, 'CONTRATOS POR VENCERCE');

                if($email->correocopia<>''){
                    $emailcopias        = explode(",", $email->correocopia);
                    $message->to($emailprincipal)->cc($emailcopias);
                }else{
                    $message->to($emailprincipal);                
                }
                $message->subject($email->descripcion);

            });

            $envio                          = 'Si';            

        }





        $fechatime                           = date("Ymd H:i:s");
        $fecha                               = date("Ymd");

        $cabecera                            = new Ilog;
        $cabecera->descripcion               = '(Sistema) Envio de correos de contratos a vencerce - '.$envio;
        $cabecera->fecha                     = $fecha;
        $cabecera->fechatime                 = $fechatime;
        $cabecera->save();

        Log::info("Correo Enviado");



    }
}
