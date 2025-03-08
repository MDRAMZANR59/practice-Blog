<?php

namespace App\Listeners;

use App\Mail\RegisterMail;
use App\Events\UserCreatesentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreatesentMail $custom): void
    {
        Mail::to($custom->user->email)->send(new RegisterMail($custom->user));
    }
}
