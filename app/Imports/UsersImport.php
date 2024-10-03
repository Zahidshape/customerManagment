<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ImportCustomers implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Customer([
            // 'name' => $row['name'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
            // 'address' => $row['address'],
            // 'postal_code' => $row['postal_code'],
            // 'country' => $row['country'],
            // 'source' => $row['source'],
        ]);
    }
}
