<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportCustomers;

class ImportCustomersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers {uploadId} {filePath}';

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
        $uploadId = $this->argument('uploadId');
        $filePath = $this->argument('filePath');
        
        Excel::import(new ImportCustomers($uploadId), $filePath);

        $this->info('Customer import completed successfully!');
    }
}
