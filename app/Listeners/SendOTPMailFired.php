<?php

namespace App\Listeners;

use App\Events\SendOTPMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendOTPMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendOTPMail $event)
    {
        $user = $event->user;
        
        Mail::send('emails.otp', $user, function($message) use ($user) {
            //$message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->from('acma@acma.in', 'ACMA');
            $message->to($user['email']);
            $message->subject('ACMA: Sign-In OTP');
        });
    }
}
