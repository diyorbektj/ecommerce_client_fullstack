<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('guid')->nullable();
        });
    }

    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
};
