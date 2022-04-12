<?php

namespace App\Repositories\Interfaces;

//use App\User;

interface ContactUsRepositoryInterface
{
    public static function all();
    public static function get($id);
    public static function insert($data);
}
?>