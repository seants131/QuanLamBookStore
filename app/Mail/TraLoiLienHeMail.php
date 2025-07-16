<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TraLoiLienHeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $noiDung;
    public $contact;

    public function __construct($noiDung, $contact)
    {
        $this->noiDung = $noiDung;
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('Phản hồi từ quản trị viên')
                    ->view('emails.tra-loi-lien-he')
                    ->with([
                        'noiDung' => $this->noiDung,
                        'contact' => $this->contact
                    ]);
    }
}