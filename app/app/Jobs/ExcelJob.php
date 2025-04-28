<?php

namespace App\Jobs;

use App\Exports\ExcelExport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;

class ExcelJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $path)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::store(new ExcelExport(), $this->path, 'excel',  \Maatwebsite\Excel\Excel::XLSX);
    }
}
