<?php

namespace App\Mail;

use App\Models\Reclamation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReclamationResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reclamation;

    /**
     * Create a new message instance.
     *
     * @param Reclamation $reclamation
     */
    public function __construct(Reclamation $reclamation)
    {
        $this->reclamation = $reclamation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Réponse à votre réclamation #'.$this->reclamation->id)
                    ->markdown('emails.reclamation-response') // Nous créerons ce template ensuite
                    ->with([
                        'reclamation' => $this->reclamation,
                    ]);
    }
}