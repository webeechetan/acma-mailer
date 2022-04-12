<?php
namespace App\Repositories;

use App\Models\GroupMember;
use App\Repositories\Interfaces\GroupMemberRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class GroupMemberRepository extends BaseRepository implements GroupMemberRepositoryInterface
{

   /**
    * GroupRepository constructor.
    *
    * @param Group $model
    */
   public function __construct(GroupMember $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): array
   {
       return $this->model->with('group')->get()->toArray();    
   }
   /**
    * @param Request $request
    * @return array
    */
   public function authenticate($request) {
    return $this->model->where(['email'=>$request->username, 'password'=>md5($request->password)])->get()->toArray();
   }
   /**
    * @param $email
    * @return array
    */
   public function findByEmail($email): array 
   {
        return $this->model->where('email', '=', $email)->get()->toArray();
   }

   /**
    * @param $email
    * @return array
    */
    public function findWhere($field, $value): array 
    {
        return $this->model->where($field, '=', $value)->get()->toArray();
    }
    /**
    * @param integer $id
    * @return bool
    */
   public function delete($id)
   {
        return $this->model->find($id)->delete();
   }
   /**
    * @param Array $attributes
    * @param integer $id
    * @return Model
    */
    public function checkRecordExist($attributes, $id) {
        return $this->model->Where('email', '=', $attributes['email'])->Where('id', '!=', $id)->get()->toArray();
   }
   /**
    * @param Array $attributes
    * @param integer $id
    * @return Model
    */
   public function update($attributes, $id) {
       if(empty($this->checkRecordExist($attributes, $id))) {
            $record = $this->model->find($id);
            $record->name = $attributes['name'];
            $record->email = $attributes['email'];
            $record->group_id = $attributes['group_id'];
            $record->created_by = $attributes['created_by'];
            return $record->save();

       } else {
           return false;
       }
   }

   
}