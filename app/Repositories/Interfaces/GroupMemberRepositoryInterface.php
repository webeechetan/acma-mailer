<?php
namespace App\Repositories\Interfaces;

use App\Models\GroupMember;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
* Interface GroupMemberRepositoryInterface
* @package App\Repositories
*/
interface GroupMemberRepositoryInterface
{
    public function all(): array;

    /**
    * @param $request
    * @return boolean
    */
    public function authenticate(Request $request);

    /**
    * @param $field
    * @param $value
    * @return array
    */
   public function findWhere(string $field, string $value): array;

    /**
    * @param $email
    * @return array
    */
   public function findByEmail(string $email): array;

   /**
    * @param int $id
    * @return Model
    */
    public function delete(int $id);
    
    /**
    * @param array $attributes
    * @param int $id
    * @return Model
    */
    public function update(array $attributes, int $id);
}