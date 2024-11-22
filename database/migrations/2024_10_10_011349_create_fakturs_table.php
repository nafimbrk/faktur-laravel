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
        Schema::create('fakturs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_faktur')->unique();
            $table->date('tanggal');
            $table->date('jatuh_tempo');
            $table->foreignId('pelanggan_id')->constrained();
            $table->decimal('total', 15, 2)->default(0); // Pastikan tipe datanya decimal
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
        
    }

    

    public function down()
    {
        Schema::dropIfExists('fakturs');
    }


};
