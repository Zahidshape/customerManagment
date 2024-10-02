<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('source'); // The source of the uploaded data
            $table->date('upload_date'); // Date of the upload
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('uploads');
    }
};
