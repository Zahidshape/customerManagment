<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDuplicate extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'customer_duplicates';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'customer_id',
        'original_upload_id',
        'duplicate_upload_id'
    ];

    // Define relationships if necessary
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function originalUpload()
    {
        return $this->belongsTo(Upload::class, 'original_upload_id');
    }

    public function duplicateUpload()
    {
        return $this->belongsTo(Upload::class, 'duplicate_upload_id');
    }
}
