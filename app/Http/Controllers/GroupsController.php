<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use Session;

class GroupsController extends Controller
{
   private $groupRepository;
  
   public function __construct(GroupRepository $groupRepository)
   {
       $this->groupRepository = $groupRepository;
   }

   public function index()
   {
       $groups = $this->groupRepository->all();
    //    dd($groups);

       return view('groups', [
           'data' => $groups
       ]);
   }

   public function create(Request $request) {
       if(isset($request->name)){
           if(empty($this->groupRepository->findByField($request))){
                $data = $request->toArray();
                $this->groupRepository->create($data);
                Session::forget('error');
                return redirect('/groups');
           } else {
                Session::put('error', 'The entered detail is already exist.');
                return redirect('/create-group');
           }
            
       } else {
            return view('add_group');
       }
       
   }

   public function delete($id) {
        $this->groupRepository->delete($id);
        return redirect('/groups');
   }

   public function edit($id) {
        $data = $this->groupRepository->find($id);
        return view('edit_group', [
            'data' => $data
        ]);
   }
   public function save(Request $request, $id) {
       $data = $request->toArray();
       $data['modified_at'] = date('Y-m-d h:i:s');
       $res = $this->groupRepository->update($data, $id);
       if($res){
            Session::forget('error');
            return redirect('/groups');
       } else {
            Session::put('error', 'The group code is already exist.');
            return redirect('/edit-group/'.$id);       
        }

   }

}