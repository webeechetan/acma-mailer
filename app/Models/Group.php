<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table        =   'groups';
    protected $fillable     =   ['name', 'modified_at'];
    public $timestamps      =   false;
    public $ordey_by        =   'DESC';
    public $column          =   'id';
}