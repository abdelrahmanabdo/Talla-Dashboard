<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SkinGlow extends Mailable
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

      if ($type === 'Cool') {
        return $this->markdown('emails.profile.cool-skin-tone-tips');
      } else if ($type === 'Warm') {
        return $this->markdown('emails.profile.warm-skin-tone-tips');
      } else if ($type === 'Neutral') {
        return $this->markdown('emails.profile.neutral-skin-tone-tips');
      } 
    }
}
