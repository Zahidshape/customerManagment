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

            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('upload_id')->references('id')->on('uploads')->onDelete('cascade');

            // Optional: Ensure uniqueness of customer-upload pairs
            $table->unique(['customer_id', 'upload_id']);
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('customer_upload_map');
    }
};
