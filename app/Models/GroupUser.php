<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $table        =   'group_user';
    protected $fillable     =   ['user_id','group_id'];
    public $timestamps      =   false;
    public $ordey_by        =   'DESC';
    public $column          =   'id';

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}