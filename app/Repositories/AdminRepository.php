<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public static function auth($request)
    {
        $adminObj = new Admin;
        return $adminObj->authenticate($request);
    }
    
}