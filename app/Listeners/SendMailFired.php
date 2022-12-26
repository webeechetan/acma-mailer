<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendMailFired
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
    public function handle(SendMail $event)
    {
        $user = $event->user;
        Mail::send('emails.mail', $user, function($message) use ($user) {
            //$emails = explode(',',$user['to_emails']);
            // $message->from('acma@acma.in');
            $from_email = $user['from_email'];
            $message->from($from_email);
            $message->to($user['to_emails']);

            if(!empty($user['cc_emails'])) {
                $cc_emails = explode(',',$user['cc_emails']);
                $message->cc($cc_emails);
            }
                

            if(!empty($user['bcc_emails'])) {
                $bcc_emails = explode(',',$user['bcc_emails']);
                $message->bcc($bcc_emails);
            }

            $message->subject($user['subject']);
            
            if(isset($user['attachments']) && $user['attachments'] != null && $user['attachments'] != '') {
                $files = explode(',', $user['attachments']);
                if(!empty($files) && count($files) != 0) {
                    foreach ($files as $file){
                        $filepath = public_path().'/storage/'.$file;
                        $message->attach($filepath);
                    }
                }
            }
           
        });
    }
}
