<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    // create_faktur_table.php
Schema::table('fakturs', function (Blueprint $table) {
    $table->decimal('sisa_tagihan', 15, 2)->after('total');
    $table->string('status')->default('belum lunas')->after('sisa_tagihan');
});

}

public function down()
{
    Schema::table('fakturs', function (Blueprint $table) {
        $table->dropColumn('sisa_tagihan');
        $table->dropColumn('status');
    });
}

};
