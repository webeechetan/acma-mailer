<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtmData extends Model
{
    protected $table        =   'utm_data';
    protected $fillable     =   ['table_id', 'table_name', 'utm_source'];
    public $timestamps      =   false;
    public $column          =   'id';

    
    
}
