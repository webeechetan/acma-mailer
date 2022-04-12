<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupMemberRepository;
use App\Events\SendOTPMail;
use Session;

class LoginController extends Controller
{
   private $groupRepository;
  
   public function __construct(GroupMemberRepository $groupMemberRepository)
   {
        $this->groupMemberRepository = $groupMemberRepository;
       
       
   }

   public function index()
   {
        if(Session::has('admin')) {
            return redirect('/compose');
        }
       $groups = $this->groupMemberRepository->all();
       return view('login');
   }

   public function login(Request $request) {
        $member = $this->groupMemberRepository->authenticate($request);
        if(isset($member) && isset($member[0]) && !empty($member[0])){
            Session::put('member', $member[0]['id']);
            Session::forget('error');
            return redirect('/authentication');
        } else {
            Session::put('error', 'The Username & Password are incorrect.');
            return redirect('/'); 
        }
        
   }

   public function OTPAuthentication() {
       $user = array();
      $otp = rand(999,9999);
    //   $otp = '1234';
       Session::put('otp', $otp);
       $id = Session::get('member');
       $member = $this->groupMemberRepository->find($id);
       $user['otp'] = $otp;
       $user['name'] = $member['name'];
       $user['email'] = $member['email'];
       Session::put('error', 'The OTP has been sent to your registered email.');
       event(new SendOTPMail($user));
       return view('authentication');
   }

   public function OTPVerification(Request $request) {
       $sentOtp = $request->otp;
       if(Session::get('otp') == $sentOtp) {
            $id = Session::get('member');
            $member = $this->groupMemberRepository->find($id);
            Session::put('admin', $member);
            Session::forget('error');
            Session::forget('otp');
            if($member['type'] == 1)
                return redirect('/compose');
            else
                return redirect('/compose');

       } else {
            Session::put('error', 'The entered OTP is incorrect.');
            return redirect('/authentication'); 
       }

   }

   public function logout()
    {
        Session::flush();
        return redirect('/'); 
    }
}