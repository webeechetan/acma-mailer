<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Repositories\SentboxRepository;
use App\Repositories\GroupRepository;
use App\Repositories\GroupUserRepository;
use App\Events\SendMail;
use Session;
use App\Jobs\SendEmailBulk;
use App\Models\Sentbox;

class SentboxController extends Controller
{
   private $sentboxRepository;
   private $groupRepository;
   private $groupUserRepository;
  
   public function __construct(SentboxRepository $sentboxRepository, GroupRepository $groupRepository, GroupUserRepository $groupUserRepository)
   {
       $this->sentboxRepository = $sentboxRepository;
       $this->groupRepository = $groupRepository;
       $this->groupUserRepository = $groupUserRepository;
   }

   public function test(){
       echo phpinfo();
   }

   public function index()
   {
        $result = array();
        $id = Session::get('admin')['id'];
        $data = $this->sentboxRepository->all($id);
        foreach($data as $key=>$d) {
            if($d['group_ids'] != '' && $d['group_ids'] != null) {
                $result[]= $d;
                $created_at = $this->findChatTimeLabel($d['created_at']);
                $result[$key]['created_at'] = $created_at;
                // $result[$key]['created_at'] = $d['created_at'];
                $result[$key]['groups'] = $this->groupRepository->findInset($d['group_ids']) ?? [];
            }
        }
        // dd($result);
        return view('sentbox',[
            'data' => $result
        ]);
   }

   public function compose($id = null) {
        $format = Sentbox::find($id);
        $groups = $this->groupRepository->all();
        return view('compose', [
            'data' => $groups,
            'format' => $format
        ]);
   }

   public function sendEmail(Request $request) {
        $paths = $users = $selectedfile = array();
        $data = $request->toArray();
        if(isset($data['selectedfile']) && !empty($data['selectedfile'])) {
            foreach ($data['selectedfile'] as $name) {
                $selectedfile[] = $name;
            }
        }
        
        if ($request->hasfile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if($file != '' && $file != null) {
                    $new_file_name = $file->getClientOriginalName();
                    if(in_array($new_file_name, $selectedfile)) {
                        $filepath = public_path().'/storage/'.$new_file_name;
                            file_put_contents($filepath, $file->getContent()) or print_r(error_get_last());
                            $paths[] = $new_file_name;
                    }
                }
            }
        }
        
        $data['attachments'] = implode(',',$paths);
        $data['sent_by'] = $sessionAdminId = Session::get('admin')['id'];
        $data['from_emails'] = $sessionAdminId = Session::get('admin')['email'];
        unset($data['deleted']);
        
        $groups = $this->groupUserRepository->groupUsers($data['group_ids']);
        if(isset($groups) && !empty($groups)) {
            foreach($groups as $key=>$user) {
                if(!in_array($user['user']['email'], $users)) {
                    $users[] = $user['user']['email'];
                }
            }
        }
        if(isset($data['to_emails']) && !empty($data['to_emails'])) {
            $emails = explode(',',$data['to_emails']);
            foreach($emails as $key=>$email) {
                $users[] = $email;
            }
        }
        
        
        
        $data['to_emails'] = implode(',',$users);
        $data['group_ids'] = implode(',', $data['group_ids']);
        $sendData = $this->sentboxRepository->create($data);
        $sentbox = $sendData->toArray();
        $sentbox['from_email'] = $data['from_email'];
        
        $toUsers = explode(',',$sentbox['to_emails']);
        if(isset($toUsers) && !empty($toUsers)) {
            foreach($toUsers as $key => $uemail) {
                $sentbox['to_emails'] = $uemail;
                    try {
                        $this->dispatch(new SendEmailBulk($sentbox));
                    } catch (\Exception $e) {
                        continue;
                        // print_r($e);
                    }
            }
        }
        
        
        
        // \Artisan::call('queue:work');
        return redirect('/sentbox');
        
       /* 
       $toUsers = explode(',',$sentbox['to_emails']);
        if(isset($toUsers) && !empty($toUsers)) {
            foreach($toUsers as $key => $uemail) {
                $sentbox['to_emails'] = $uemail;
                    try {
                        event(new SendMail($sentbox));
                    } catch (\Exception $e) {
                        continue;
                    }
            }
        }
        
        try {
            event(new SendMail($sendData->toArray()));
        } catch (\Exception $e) { }
        return redirect('/sentbox');
        */
   }
   public function findChatTimeLabel($timestamp) {
        $time_ago        = strtotime($timestamp);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;

        $minutes = round($seconds / 60); // value 60 is seconds
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
        $weeks   = round($seconds / 604800); // 7*24*60*60;
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

        if ($seconds <= 60){

        return "Today";

        } else if ($minutes <= 60){

            return "Today";
           
        } else if ($hours <= 24){
            
            return "Today";
           

        } else if ($days <= 7){

        if ($days == 1){

            return "Yesterday";

        } else {
            return date('l', strtotime($timestamp));

           

        }

        } else if ($weeks <= 4.3){

        if ($weeks == 1){

            return "a week ago";

        } else {

            return "$weeks weeks ago";

        }

        } else if ($months <= 12){
            
        return date("F", strtotime($timestamp));
        

        } else {

            if ($years == 1){

                return "one year ago";

            } else {

                return "$years years ago";

            }
        }
    }
   public function mailDetail($id) {
       $attachments = array();
        $data = $this->sentboxRepository->find($id);
        $data['attachments'] = explode(',', $data['attachments']);
        foreach($data['attachments'] as $attachment) {
            $ext = strtolower(pathinfo($attachment, PATHINFO_EXTENSION));
            $path ="";
            $path = url('storage/'.$attachment);
            $icon = "";
            switch($ext) {
                case "pdf":
                    $icon = '<i style="font-size:40px;" class="fa fa-file-pdf-o" aria-hidden="true"></i>';
                    break;
                case "doc":
                    $icon = '<i style="font-size:40px;" class="fa fa-file-word-o" aria-hidden="true"></i>';
                    break;
                case "docx":
                    $icon = '<i style="font-size:40px;" class="fa fa-file-word-o" aria-hidden="true"></i>';
                    break;
                case "xlsx":
                    $icon = '<i style="font-size:40px;" class="fa fa-file-excel-o" aria-hidden="true"></i>';
                    break;
                case "png":
                    $icon = '<i style="font-size:40px;" class="fa fa-picture-o" aria-hidden="true"></i>';
                    break;
                case "jpeg":
                    $icon = '<i style="font-size:40px;" class="fa fa-picture-o" aria-hidden="true"></i>';
                    break;
                case "jpg":
                    $icon = '<i style="font-size:40px;" class="fa fa-picture-o" aria-hidden="true"></i>';
                    break;
                case "csv":
                    $icon = '<i style="font-size:40px;" class="fa fa-file" aria-hidden="true"></i>';
                    break;
                
            }
            $attachments[]= array('icon'=> $icon, 'path'=> $path);
        }
        $groups = $this->groupRepository->findInset($data['group_ids']);
        return view('mail_detail',[
            'data' => $data,
            'attachments' => $attachments,
            'groups' => $groups
        ]);
   }
}