<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_faktur', 
        'tanggal', 
        'jatuh_tempo', 
        'pelanggan_id', 
        'catatan',
        'total',
        'tempo_hari',
        'sisa_tagihan',
        'status',
        'label_pajak',
        'pajak',
        'diskon_faktur',
                'keuntungan'

    ];
    

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function items()
    {
        return $this->hasMany(FakturItem::class);
    }


    


public function pembayarans()
    {
        return $this->hasMany(PembayaranFaktur::class);
    }

    
}

