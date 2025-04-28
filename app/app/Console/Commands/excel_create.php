<?php

namespace App\Console\Commands;

use App\Services\System\ExcelService;
use Illuminate\Console\Command;

class excel_create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = new ExcelService()->export();
        $this->info("Successful created job; $path");
    }
}
