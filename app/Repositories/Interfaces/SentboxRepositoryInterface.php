<?php
namespace App\Repositories\Interfaces;

use App\Models\Group;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
* Interface GroupRepositoryInterface
* @package App\Repositories
*/
interface SentboxRepositoryInterface
{
    public function all(int $id): array;
    
    /**
    * @param int $id
    * @return Model
    */
    public function delete(int $id);
}