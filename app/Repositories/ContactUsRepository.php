<?php

namespace App\Repositories;

use App\Models\ContactUs;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;

class ContactUsRepository implements ContactUsRepositoryInterface
{
    public static function all()
    {
        $contactObj =  new ContactUs();
        return $contactObj->getAll();
    }
    public static function get($id)
    {
        $contactObj =  new ContactUs();
        return $contactObj->get($id);
    }
    public static function insert($data)
    {
       
        $contactObj =  new ContactUs();
        return $contactObj->insertLead($data);
        
    }
   
}