<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('uploads', function (Blueprint $table) {
        $table->timestamp('upload_date')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
    });
}

public function down(): void
{
    Schema::table('uploads', function (Blueprint $table) {
        $table->timestamp('upload_date')->nullable(false)->change(); // Revert changes if needed
    });
}
};
