<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContactUsRepository;

class ContactUsController extends CommonController
{   
    private $data = array();
    public function __construct()
    {
        $this->data = [];
    }

    public function index()
    {
        $this->data = ContactUsRepository::all();
        
        return view('contactus', ["data"=>$this->data]);
    }

    public function save(Request $request)
    {
        $insert = ContactUsRepository::insert($request);
        $this->saveUtmData($request, array('id'=>$insert, 'table'=>'contact_us'));
        if($insert) {
            return array("success"=>true, "msg"=>"Thank you! our team will get in touch with you soon.");
        } else {
            return array("success"=>false, "msg"=>"Happy to see you again,You have already order for the same information!");
        }
        
        
    }

    // Download CSV for unpaid users
    public function leadsCSV(){
        $result = ContactUsRepository::all();
        $filename           =   'Contact List-'.date('d/m/Y');

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$filename.'.csv');

        $output             =   fopen('php://output', 'w');
        $names              =   array('Name','Email', 'Phone', 'Message', 'Date');
        $count              =   0;

        fputcsv($output,$names);

        if(isset($result) && !empty($result)){
            foreach($result as $data){
                $modifiedData = array($data['name'], $data['email'], $data['phone'], $data['message'], date('Y-m-d h:i a',strtotime($data['created_at'])));
                fputcsv($output,$modifiedData);
            }
        }
    }
}
