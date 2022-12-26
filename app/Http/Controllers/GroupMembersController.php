<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Repositories\GroupMemberRepository;
use Session;

class GroupMembersController extends Controller
{
   private $groupMemberRepository;
   private $groupRepository;
  
   public function __construct(GroupMemberRepository $groupMemberRepository, GroupRepository $groupRepository)
   {
       $this->groupMemberRepository = $groupMemberRepository;
       $this->groupRepository = $groupRepository;
   }

   public function index()
   {
       $members = $this->groupMemberRepository->all();
       return view('group_members', [
           'data' => $members
       ]);
   }

   public function create(Request $request) {
       if(isset($request->email)){
            $data = $request->toArray();
            $data['password'] = md5($data['password']);
            $this->groupMemberRepository->create($data);
            return redirect('/group-members');
       } else {
            $groups = $this->groupRepository->all();
            $sessionAdminId = Session::get('admin')['id'];

            return view('add_group_member', [
                'data' => $groups,
                'created_by' => $sessionAdminId
            ]);
       }
       
   }
   
   public function delete($id) {
        $this->groupMemberRepository->delete($id);
        return redirect('/group-members');
   }

   public function edit($id) {
        $data = $this->groupMemberRepository->find($id);
        $groups = $this->groupRepository->all();
        return view('edit_group_member', [
            'groups' => $groups,
            'data' => $data
        ]);
    }
    public function save(Request $request, $id) {
        $data = $request->toArray();
        $data = $this->groupMemberRepository->update($data, $id);
        if($data){
             Session::forget('error');
             return redirect('/group-members');
        } else {
             Session::put('error', 'The entered email Id is already exist.');
             return redirect('/edit-group-member/'.$id);       
         }
 
    }

}