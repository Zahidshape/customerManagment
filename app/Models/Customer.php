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
        // 'name',
        'email',
        'phone_number',
        // 'address',
        // 'postcode',
        // 'country',
        // 'source'
    ];

    // Define the unique fields
    public static $rules = [
        'email' => 'required|email|unique:customers,email',
        'phone_number' => 'required|unique:customers,phone_number'
    ];
}
