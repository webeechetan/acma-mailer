<?php
namespace App\Repositories;

use App\Models\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{

   /**
    * GroupRepository constructor.
    *
    * @param Group $model
    */
   public function __construct(Group $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all()->sortBy("name");    
   }
   /**
    * @param Request $request
    * @return array
    */
   public function findByField($request): array
   {
        return $this->model->where('name', '=', $request->title)->get()->toArray();
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
        return $this->model->Where('name', '=', $attributes['name'])->Where('id', '!=', $id)->get()->toArray();
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
            $record->modified_at = $attributes['modified_at'];
            return $record->save();
       } else {
           return false;
       }
   }

   public function findInset($groupIds) {
        $ids = explode(',', $groupIds);
        return $this->model->whereIn('id', $ids)->get()->toArray();
   }
}