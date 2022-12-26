<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * GroupRepository constructor.
     *
     * @param Group $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
 
    /**
     * @return Collection
     */
    public function all(): array
    {
        return $this->model->with('user')->get()->toArray();    
    }
    /**
     * @param Request $request
     * @return array
     */
    public function authenticate($request) {
     return $this->model->where(['email'=>$request->username, 'password'=>md5($request->password),'type'=>1])->get()->toArray();
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
             $record->email = $attributes['email'];
             $record->modified_at = date('Y-m-d h:i:s');
             return $record->save();
 
        } else {
            return false;
        }
    }

    public function allGroupUsers($attribute= array()){
       return $data=  $this->model->with(array('userGroup'=>function($query){
            
        }))->with('userGroup.group')->get()->toArray();  
       
    }
    /**
    * @return Collection
    */
    public function get($id): array
    {
        return $this->model->with('userGroup')->where('id','=', $id)->get()->toArray();    
    }

 }