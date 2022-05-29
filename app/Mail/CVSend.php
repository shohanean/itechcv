<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CVSend extends Mailable
{
    use Queueable, SerializesModels;

public $value;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        return $this->value = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('welcome')
              ->attach(asset('images/profile/1.jpg'));
    }
}
