<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $table        =   'users';
    protected $fillable     =   ['email', 'created_at'];
    public $timestamps      =   false;
    public $ordey_by        =   'DESC';
    public $column          =   'id';

    public function userGroup()
    {
        return $this->hasMany('App\Models\GroupUser', 'user_id', 'id');
    }

   

    
}
