<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('customer_upload_map', function (Blueprint $table) {
            $table->boolean('is_duplicate')->default(false)->after('upload_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_upload_map', function (Blueprint $table) {
            $table->dropColumn('is_duplicate');
        });
    }
};
