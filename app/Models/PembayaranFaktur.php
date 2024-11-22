<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranFaktur extends Model
{
    use HasFactory;

    protected $fillable = ['faktur_id', 'jumlah_bayar', 'tanggal_bayar', 'metode_bayar'];

    public function faktur()
    {
        return $this->belongsTo(Faktur::class);
    }
}
