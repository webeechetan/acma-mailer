<?php
namespace App\Repositories;

use App\Models\GroupUser;
use App\Repositories\Interfaces\GroupUserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class GroupUserRepository extends BaseRepository implements GroupUserRepositoryInterface
{

   /**
    * GroupRepository constructor.
    *
    * @param Group $model
    */
   public function __construct(GroupUser $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): array
   {
       return $this->model->with(['group','user'])->get()->toArray();    
   }
  
   
   public function delete($id)
   {
        return $this->model->find($id)->delete();
   }
   public function deleteByUserId($user_id)
   {
        return $this->model->where('user_id', '=', $user_id)->delete();
   }
   /**
    * @return Collection
    */
    public function groupUsers($ids): array
    {
        return $this->model->with(['group','user'])->whereIn('group_id', $ids)->get()->toArray();    
    }
    /**
    * @param Array $attributes
    * @param integer $id
    * @return Model
    */
   public function update($attributes, $id) {
        if(empty($this->checkRecordExist($attributes, $id))) {
            $record = $this->model->find($id);
            $record->user_id = $attributes['user_id'];
            $record->group_id = $attributes['group_id'];
            return $record->save();

        } else {
            return false;
        }
    }
    /**
    * @return Collection
    */
    public function get($id): array
    {
        return $this->model->with(['group','user'])->where('id','=', $id)->get()->toArray();    
    }
}