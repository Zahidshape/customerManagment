<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCustomers;

class ProcessFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $filePath;
    protected $uploadId;

    public function __construct($filePath, $uploadId)
    {
        $this->filePath = $filePath;
        $this->uploadId = $uploadId;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = $this->filePath;

        Excel::import(new ImportCustomers($this->uploadId), $file);
    }
}
