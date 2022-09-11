<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BodyShape extends Mailable
{
    use Queueable, SerializesModels;
    
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
      $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $type = $this->data['type'];

      if ($type === 'Attractive') {
        return $this->markdown('emails.profile.apple-shape-tips');
      } else if ($type === 'Glamourous') {
        return $this->markdown('emails.profile.hourglass-shape-tips');
      } else if ($type === 'Charming') {
        return $this->markdown('emails.profile.inverted-triangle-shape-tips');
      } else if ($type === 'Captivating') {
        return $this->markdown('emails.profile.rectangle-shape-tips');
      } else if ($type === 'Hottie') {
        return $this->markdown('emails.profile.triangle-shape-tips');
      }
    }
}
