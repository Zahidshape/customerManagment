<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUploadMap extends Model
{
    use HasFactory;
    protected $table = 'customer_upload_map';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'upload_id',
        'is_duplicate',
    ];
    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
