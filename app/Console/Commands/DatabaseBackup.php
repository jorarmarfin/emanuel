<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup de la base de Datos';

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
        $fecha = date('Ymd.his');
        $db_name = env('DB_DATABASE');
        $db_user = env('DB_USERNAME');
        $db_pass = env('DB_PASSWORD');
        $archivo = $db_name.'-'.$fecha.'.sql';
        $comando = 'mysqldump -u'.$db_user.' -p'.$db_pass.' '.$db_name.'>'.$archivo;
        shell_exec($comando);
        shell_exec('gzip '.$archivo);
        $this->info('Backup de la base de datos creada ');
    }
}
