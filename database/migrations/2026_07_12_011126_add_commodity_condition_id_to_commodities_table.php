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
        Schema::table('commodities', function (Blueprint $table) {

            $table->foreignId('commodity_condition_id')
                  ->nullable()
                  ->after('commodity_acquisition_id')
                  ->constrained('commodity_conditions')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commodities', function (Blueprint $table) {

            $table->dropForeign(['commodity_condition_id']);
            $table->dropColumn('commodity_condition_id');

        });
    }
};