<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pelanggans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('email')->unique();
        $table->string('nomor_telepon');
        $table->text('informasi_tambahan')->nullable();
        $table->string('alamat');
        $table->string('kota');
        $table->string('kode_pos');
        $table->string('provinsi');
        $table->string('negara');
        $table->string('alamat_pengiriman');
        $table->string('kota_pengiriman');
        $table->string('kode_pos_pengiriman');
        $table->string('provinsi_pengiriman');
        $table->string('negara_pengiriman');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
