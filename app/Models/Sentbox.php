<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentbox extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $table        =   'sentbox';
    protected $fillable     =   ['sent_by','to_emails', 'cc_emails','bcc_emails','from_emails','subject', 'body', 'attachments','group_ids'];
    public $timestamps      =   false;
    public $ordey_by        =   'DESC';
    public $column          =   'id';
}