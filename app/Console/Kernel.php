<?php

namespace App\Console;

use App\Console\Commands\EmailCumpleanios;
use App\Console\Commands\ContratosVencer;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

//es esta
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    // aca por ejemplo estamos como que declarando que vamos a ejecutar estas dos clases ok? ok  pero hagamos un envio 
    protected $commands = [
        EmailCumpleanios::class,
        ContratosVencer::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        // aca donde vas a configurar las horas que se enviaran
        $schedule->command('trabajador:cumpleanios')->dailyAt('10:00');
        $schedule->command('trabajador:contrato')->dailyAt('11:52');

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
