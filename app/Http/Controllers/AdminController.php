<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AdminRepository;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if ($request->session()->has('admin'))
            return redirect('/preOrderListing');
        else
            return view('login');
    }

    public function authenticate(Request $request)
    {
        
        $admin = AdminRepository::auth($request);
        if($admin){
            Session::put('admin', $admin);
            Session::forget('error');
            return redirect('/preOrderListing');
        } else {
            Session::put('error', 'The Username & Password are incorrect.');
            return redirect('/'); 
        }
    }
    public function logout()
    {
        
        Session::flush();
        return redirect('/'); 
    }
}
