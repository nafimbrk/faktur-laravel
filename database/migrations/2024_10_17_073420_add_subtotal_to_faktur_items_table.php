<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('faktur_items', function (Blueprint $table) {
            $table->decimal('subtotal', 10, 2)->default(0); // Tambahkan kolom subtotal
        });
    }

    public function down()
    {
        Schema::table('faktur_items', function (Blueprint $table) {
            $table->dropColumn('subtotal');
        });
    }
};
