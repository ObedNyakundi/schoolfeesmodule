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
       Schema::table('fee_payments', function (Blueprint $table) {
           /* $table ->dropColumn('payment_mode');
            $table ->dropColumn('type_of_fees');
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fee_payments', function (Blueprint $table) {
           /* $table->string('payment_mode');
            $table->string('type_of_fees');
            */
        });
    }
};
