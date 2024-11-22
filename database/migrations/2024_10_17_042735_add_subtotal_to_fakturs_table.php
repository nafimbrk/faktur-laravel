<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('fakturs', function (Blueprint $table) {
        $table->integer('tempo_hari')->nullable();
    });
}

public function down()
{
    Schema::table('fakturs', function (Blueprint $table) {
        $table->dropColumn('tempo_hari');
    });
}

};
