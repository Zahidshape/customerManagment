<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'uploads';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'file_name',
        'source',
        'date'
    ];

    // Define relationships if necessary
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}

