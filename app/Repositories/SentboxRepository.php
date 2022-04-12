<?php
namespace App\Repositories;

use App\Models\Sentbox;
use App\Repositories\Interfaces\SentboxRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class SentboxRepository extends BaseRepository implements SentboxRepositoryInterface
{

   /**
    * GroupRepository constructor.
    *
    * @param Sentbox $model
    */
   public function __construct(Sentbox $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all($id): array
   {
       return $this-> model->where(['sent_by'=>$id]) -> orderBy('created_at', 'desc') -> get() -> toArray();    
   }
   
   /**
    * @param integer $id
    * @return bool
    */
   public function delete($id)
   {
        return $this->model->find($id)->delete();
   }
   
   
}