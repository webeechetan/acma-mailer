<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table        =   'admin';
    protected $fillable     =   ['name', 'email', 'password',];
    public $timestamps      =   false;
    public $perPageLimit    =   10;
    public $totalCount      =   0;
    public $pages           =   5; // Pages links per page
    public $previouspages   =   2;
    public $nextpages       =   2;
    public $ordey_by        =   'DESC';
    public $column          =   'id';
    public $data;

    public function authenticate($data){
        $this->data = $data;
        $admin  =   $this->whereemail($this->data['username'])->wherepassword(md5($this->data['password']))->get()->toArray();
        
        if($admin)
        {
            
            return $admin;
            
        }
        return  false;
    }
    
}
