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
        Schema::table('customers', function (Blueprint $table) {
            // Add new columns
            $table->string('name')->nullable()->after('id');
            $table->string('email')->unique()->nullable()->after('name');
            $table->string('phone_number')->unique()->nullable()->after('email');
            $table->string('address')->nullable()->after('phone_number');
            $table->string('postcode')->nullable()->after('address');
            $table->string('country')->nullable()->after('postcode');
            $table->string('source')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Drop the columns
            $table->dropColumn([
                'name',
                'email',
                'phone_number',
                'address',
                'postcode',
                'country',
                'source',
            ]);
        });
    }
};
