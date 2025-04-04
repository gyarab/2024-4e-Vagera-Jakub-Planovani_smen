<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbBackup extends Command
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
    protected $description = 'Create Database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * @source: https://www.youtube.com/watch?v=fQgZ8P35YHM
         */
        $filename = "backup_" . strtotime(now()).".sql";
        $command = "mysqldump --user=".env('DB_USERNAME')." --password=". env('DB_PASSWORD')." --host=" . env('DB_HOST')." ".env('DB_DATABASE')." > ".storage_path()."/app/public/backup/".$filename;
        exec($command);
        //
    }
}
