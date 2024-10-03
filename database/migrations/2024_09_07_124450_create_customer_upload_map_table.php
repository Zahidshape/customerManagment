<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('customer_upload_map', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('customer_id'); // Foreign key to customers table
            $table->unsignedBigInteger('upload_id'); // Foreign key to uploads table
            $table->timestamps(); // Created_at and updated_at timestamps

          

        });
    }

   
    public function down()
    {
        Schema::dropIfExists('customer_upload_map');
    }
};
