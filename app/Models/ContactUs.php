<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table        =   'contact_us';
    protected $fillable     =   ['name', 'email', 'phone', 'message'];
    public $timestamps      =   false;
    public $perPageLimit    =   10;
    public $totalCount      =   0;
    public $pages           =   5; // Pages links per page
    public $previouspages   =   2;
    public $nextpages       =   2;
    public $ordey_by        =   'DESC';
    public $column          =   'id';
    public $data;

    public function utm()
    {
        return $this->hasOne('App\Models\UtmData', 'table_id', 'id')->where('table_name', "contact_us");
    }
    public function insertLead($data)
    {
        $this->data =   $data;
        $this->name         =   $this->data['name'];
        $this->email        =   $this->data['email'];
        $this->phone        =   $this->data['phone'];
        $this->message      =   $this->data['message'];
        $this->save();
        return $this->id;
        
    }
    public function get($id){
        $this->id    =   $id;
        return $this->find($this->id)->toArray();
    }
    public function getAll() {
        $all = $this->with('utm')->get()->toArray();
        return $all;
    }

    
}