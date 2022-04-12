<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $table        =   'group_members';
    protected $fillable     =   ['name','email', 'password','group_id', 'created_by'];
    public $timestamps      =   false;
    public $ordey_by        =   'DESC';
    public $column          =   'id';

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }
}