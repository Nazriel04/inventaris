<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('commodities', function (Blueprint $table) {
            $table->dropColumn('commodity_acquisition_id');
        });
    }

    public function down()
    {
        Schema::table('commodities', function (Blueprint $table) {
            $table->unsignedBigInteger('commodity_acquisition_id')->nullable();
        });
    }
};