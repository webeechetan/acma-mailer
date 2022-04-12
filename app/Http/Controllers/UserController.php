<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();

        return view('user', ["data"=>$users]);
    }

    public function detail($id)
    {
        // $user = User::find($id);
        // $blogs = $this->userRepository->getByUser($user);

        // return view('user')->withBlogs($blogs);
    }
}
