<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'faktur_id', 
        'barang_id', 
        'kuantitas', 
        'diskon',
        'subtotal',
        'label_pajak',
        'pajak'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function faktur()
    {
        return $this->belongsTo(Faktur::class);
    }
}
