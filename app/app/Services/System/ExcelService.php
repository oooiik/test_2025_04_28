<?php

namespace App\Services\System;

use App\Jobs\ExcelJob;
use Carbon\Carbon;

class ExcelService
{
    public function export(): string
    {
        $path = Carbon::now()->getTimestampMs() . '.xlsx';
        ExcelJob::dispatch($path);
        return $path;
    }
}