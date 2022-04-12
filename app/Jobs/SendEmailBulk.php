<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\SendMail;

class SendEmailBulk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $sentbox;
    public function __construct($sentbox)
    {
        $this -> sentbox = $sentbox;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sentbox = $this -> sentbox;
        event(new SendMail($sentbox));
        // $toUsers = explode(',',$sentbox['to_emails']);
        // if(isset($toUsers) && !empty($toUsers)) {
        //     foreach($toUsers as $key => $uemail) {
        //         $sentbox['to_emails'] = $uemail;
        //             try {
        //                 event(new SendMail($sentbox));
        //             } catch (\Exception $e) {
        //                 continue;
        //             }
        //     }
        // }
        
        
        
        // for($i = 0; $i <= 100; $i++) {
        //     $dataObj = [
        //         "to_emails" => "anku.pathak@webeesocial.com",
        //         "from_email" => "acma@acma.in",
        //         "subject" => "Testing Purpose Looping {$i}",
        //         "body" => "Looping  {$i}"
        //     ];
        //     event(new SendMail($dataObj));
        // }
        
    }
}
