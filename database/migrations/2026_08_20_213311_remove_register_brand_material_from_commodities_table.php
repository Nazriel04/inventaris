<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('commodities', function (Blueprint $table) {
        if (Schema::hasColumn('commodities', 'register')) {
            $table->dropColumn('register');
        }

        if (Schema::hasColumn('commodities', 'brand')) {
            $table->dropColumn('brand');
        }

        if (Schema::hasColumn('commodities', 'material')) {
            $table->dropColumn('material');
        }
    });
}

    public function down()
    {
        Schema::table('commodities', function (Blueprint $table) {
            $table->string('register');
            $table->string('brand');
            $table->string('material');
        });
    }
};