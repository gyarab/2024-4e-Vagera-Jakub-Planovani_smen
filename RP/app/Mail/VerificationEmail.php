<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    /**
     * Get the message envelope.
     */

     use Queueable, SerializesModels;

     public $details; // Pass data to the email
 
     /**
      * Create a new message instance.
      *
      * @param array $details
      */
     public function __construct($details)
     {
         $this->details = $details;
     }
 
     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
         return $this->subject('Custom Email Subject')
                     ->view('email-verification'); // Point to the email view
     }



    /*public function __construct(private $name){

    }*/
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification Email',
           /* from: new Address('vageja5zs@gmail.com', 'Jakub')*/
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email-verification',
          
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
