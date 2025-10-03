<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('pharmacist_details', function (Blueprint $table) {
            //
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('pharmacist_details', function (Blueprint $table) {
            $table->text('phone')->nullable()->after('specialization');
            $table->text('address')->nullable()->after('phone');
        });
    }
};
