<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'customers';

    // Define the attributes that are mass assignable
    protected $fillable = [
       
        'first_name' ,
        'last_name' ,
        'phone_number' ,
        'email',
        'address',
        'postcode',
        'county',
        'created_at',
        'updated_at',
    ];

    // Define the unique fields
    public static $rules = [
        'email' => 'required|email|unique:customers,email',
        'phone_number' => 'required|unique:customers,phone_number'
    ];
    public function upload()
    {
        return $this->belongsTo(Upload::class,  'upload_id', 'id');
    }
}
