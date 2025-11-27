<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $nama;

    public function __construct($otp, $nama = null)
    {
        $this->otp = $otp;
        $this->nama = $nama;
    }

    public function build()
    {
        return $this->subject('Kode OTP Registrasi PPDB SMK Bakti Nusantara 666')
                    ->view('emails.otp');
    }
}