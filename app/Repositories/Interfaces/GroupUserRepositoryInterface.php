<?php
namespace App\Repositories\Interfaces;

use App\Models\GroupUser;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
* Interface GroupMemberRepositoryInterface
* @package App\Repositories
*/
interface GroupUserRepositoryInterface
{
    public function all(): array;

   /**
    * @param int $id
    * @return Model
    */
    public function delete(int $id);
    /**
    * @param int $id
    * @return Model
    */
    public function get(int $id);
    /**
    * @param array $attributes
    * @param int $id
    * @return Model
    */
    public function update(array $attributes, int $id);
    
    
}