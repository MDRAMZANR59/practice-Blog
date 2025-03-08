<?php

namespace App\Mail;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogCreateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $email;
    /**
     * Create a new message instance.
     */
    public function __construct(Blog $blog, )
    {
        $this->data=$blog;
        // $this->email=$user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Blog Create Mail',
        );
    }

    public function build(){
        return $this->view('backend.layout.newblog')->with(['title'=> $this->data->title,]);
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
