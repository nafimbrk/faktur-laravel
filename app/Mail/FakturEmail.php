<?php

namespace App\Mail;

use App\Models\Faktur;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FakturEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $faktur;

    public function __construct(Faktur $faktur)
    {
        $this->faktur = $faktur;
    }

    public function build()
    {
        return $this
            ->subject('Informasi Sisa Tagihan')
            ->view('emails.faktur')
            ->with([
                'sisaTagihan' => $this->faktur->sisa_tagihan,
            ]);
    }
}
