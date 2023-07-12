<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;
use App\Repositories\GroupUserRepository;
use Session;
use App\Models\Group;
use App\Models\User;
use App\Models\GroupUser;

class GroupUsersController extends Controller
{
   private $groupUserRepository;
   private $groupRepository;
   private $userRepository;
  
   public function __construct(GroupUserRepository $groupUserRepository, GroupRepository $groupRepository, UserRepository $userRepository)
   {
       $this->groupUserRepository = $groupUserRepository;
       $this->groupRepository = $groupRepository;
       $this->userRepository = $userRepository;
   }

   public function index()
   {
        $data = $this->userRepository->allGroupUsers();
        // dd($data);
        return view('group_users', [
                'data' => $data
            ]);
   }

   public function create(Request $request) {
       $user = array();
       if(isset($request->email)){
            $data = $request->toArray();
            $user['email'] = $data['email'];
            if( empty($this->userRepository->findByEmail($user['email'])) ) {
                $user = $this->userRepository->create($user);
                $id = $user['id'];
                if( isset($data['group_id']) && !empty($data['group_id']) ){
                    foreach($data['group_id'] as $key=>$group_id) {
                        $user_groups = array();
                        $user_groups['user_id'] = $id;
                        $user_groups['group_id'] = $group_id;
                        $this->groupUserRepository->create($user_groups);
                    }
                }
                Session::forget('error');
                return redirect('/group-users');
            } else {
                Session::put('error', 'The email is already exist.');
                return redirect('/create-group-user');
            }
            
       } else {
            $groups = $this->groupRepository->all();

            return view('add_group_user', [
                'groups' => $groups
            ]);
       }
       
   }
   
   public function delete($id) {
        $this->groupUserRepository->deleteByUserId($id);
        $this->userRepository->delete($id);
        return redirect('/group-users');
    }

    public function edit($id) {
        $data = $this->userRepository->get($id);
        if(isset($data) && !empty($data[0])) {
            foreach($data[0]['user_group'] as $key=>$user_group) {
                $groupids[] = $user_group['group_id'];
            }
        }
        
        $groups = $this->groupRepository->all();
        return view('edit_group_user', [
            'groups' => $groups,
            'data' => $data[0],
            'groupids'=> $groupids
        ]);
    }
    public function save(Request $request, $id) {
        $user_group = array();
        $data = $request->toArray();
        $res = $this->userRepository->update($data, $id);
        if($res){
            $this->groupUserRepository->deleteByUserId($id);
            if(isset($data['group_id']) && !empty($data['group_id'])){
                foreach($data['group_id'] as $key=>$group_id) {
                    $user_group['user_id'] = $id;
                    $user_group['group_id'] = $group_id;
                    $this->groupUserRepository->create($user_group);
                }
            }
        }
        if($res){
            Session::forget('error');
            return redirect('/group-users');
        } else {
            Session::put('error', 'The entered email Id is already exist.');
            return redirect('/edit-group-user/'.$id);       
        }

    }
    public function import(Request $request) {
        

        if($request->file('csv')){
            $file = $request->file('csv');
            $file_handle = fopen($file->getPathName(), 'r');
            $i=0;
            $row=[];
            $unique = [];
            while (!feof($file_handle) ) {
                $i++;
                if($i==1) { continue; }
                $data   =   fgetcsv($file_handle);
                if(!$data){
                    continue;
                }
                $email = $data[0];
                $group = $data[1];
                
                $list = explode(',',$group);
                $usergroup =[];
                foreach($list as $key =>$value){
                    $unique[] =trim($value) ;
                    $usergroup[] =trim($value) ;
                }
                $row[$email] = $usergroup;
                //$this->groupUserRepository->che ();

            }

            
            
            // all groups from csv
            $users = array_unique($unique);
            foreach($row as $key => $value){
                $user = User::where('email',$key)->first();
                if(!$user){
                   $user = new User();
                   $user->email = $key;
                   $user->save(); 
                }
                $grps = [];
                if($user){
                    foreach($value as $group_name){
                        $group = Group::where('name',$group_name)->first();
                        array_push($grps,$group->id);
                    }
                    $user->getGroups()->sync($grps);
                }
            }
       

             fclose($file_handle);
             return redirect('/group-users');
        } else {
            $groups = $this->groupRepository->all();
            $sessionAdminId = Session::get('admin')['id'];

            return view('import_group_member', [
                'data' => $groups,
                'created_by' => $sessionAdminId
            ]);
        }
        
    }
    public function getGroupUsers(Request $request) {
        $users = array();
        $data = $request->toArray();
        $group_ids = json_decode($data['group_ids']);
        $groups = $this->groupUserRepository->groupUsers($group_ids);
        if(isset($groups) && !empty($groups)){
            foreach($groups as $key=>$user) {
                if(!in_array($user['user']['email'], $users)) {
                    $users[] = $user['user']['email'];
                }
                
            }
        }
        echo json_encode(array('users'=>$users));
    }

    // Download CSV for unpaid users
    public function exportCSV() {
        $dataCSV = array();
        $result = $this->userRepository->allGroupUsers();
        
        $filename           =   'Group-users-'.date('d/m/Y');

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$filename.'.csv');

        $output             =   fopen('php://output', 'w');
        $names              =   array('Email', 'Groups', 'Created At', 'Modified At');
        $count              =   0;

        fputcsv($output,$names);

        if(isset($result) && !empty($result)){
            foreach($result as $data){
                $groups = array();
                if(isset($data['user_group']) && !empty($data['user_group'])){
                    foreach($data['user_group'] as $grp){
                        $groups[] = $grp['group']['name'];
                    }
                }
                $dataCSV[] = array(
                    'email' => $data['email'],
                    'groups' => implode(', ',$groups),
                    'created_at' => date('Y-m-d h:i a',strtotime($data['created_at'])),
                    'modified_at' => date('Y-m-d h:i a',strtotime($data['modified_at']))
                );
            }
        }
        
        if(isset($dataCSV) && !empty($dataCSV)) {
            foreach($dataCSV as $data) {
                fputcsv($output,$data);
            }
        }
    }

}