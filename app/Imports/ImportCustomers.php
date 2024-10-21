<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\CustomerUploadMap;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ImportCustomers implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    protected $uploadId;
    protected $chunkSize = 3;
    protected $records = [];

    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    public function model(array $row)
    {
        $this->records[] = $row;
        if (count($this->records) >= $this->chunkSize) {
            $this->processChunk();
            $this->records = []; 
        }

        return null;
    }

    public function chunkSize(): int
    {
        return 1000;  
    }

    public function batchSize(): int
    {
        return $this->chunkSize;  
    }

    protected function processChunk()
    {
        $customersToInsert = [];
        $duplicates = [];

        foreach ($this->records as $row) {
            // dd($row);
            $customer = Customer::where('email', $row['email'])
                                ->orWhere('phone_number', $row['phone_number'])
                                ->first();

            if ($customer) {
                
                $duplicates[] = [
                    'customer_id' => $customer->id,
                    'upload_id' => $this->uploadId,
                    'is_duplicate' => true,
                ];
            } else {
                
                $customersToInsert[] = [
                    'upload_id' => $this->uploadId,
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'phone_number' => $row['phone_number'],
                    'email' => $row['email'],
                    'address' => $row['months_at_address'],
                    'postcode' => $row['postcode'],
                    'county' => $row['county'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert records into the database
        if (!empty($customersToInsert)) {
            Customer::insert($customersToInsert);
        }

        if (!empty($duplicates)) {
            CustomerUploadMap::insert($duplicates);
        }
    }
}