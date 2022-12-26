<?php
namespace App\Repositories\Interfaces;

use App\Models\Group;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
* Interface GroupRepositoryInterface
* @package App\Repositories
*/
interface GroupRepositoryInterface
{
    public function all(): Collection;

    /**
    * @param Request $request
    * @return array
    */
   public function findByField(Request $request): array;
   /**
    * @param Request $request
    * @return array
    */

    /**
    * @param array $attributes
    * @param int $id
    * @return Model
    */
    public function update(array $attributes, int $id);

    /**
    * @param int $id
    * @return Model
    */
    public function delete(int $id);
}