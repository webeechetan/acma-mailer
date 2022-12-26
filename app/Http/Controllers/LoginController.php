<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GroupMemberRepository;
use App\Events\SendOTPMail;
use App\Models\GroupMember;
use App\Mail\PasswordResetMail;
use Session;
use Carbon\Carbon;

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
            // dd($member);
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

    public function forget_password_view(){
        return view('forget_password');
    }

    public function forget_password(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = GroupMember::where('email',$request->email)->first();

        if($user){
            $otp = rand(000000,999999);
            $user->otp = $otp;
            $user->save();
            \Mail::to($user->email)->send(new PasswordResetMail($user->email,$otp));
            Session::put('error', 'Password reset link sended on your registred email. Link valid for 10 Minutes ');
            return back();
        }else{
            Session::put('error', 'Email Not Exist In Our Database');
            return back();
        }
        return $request;
    }

    public function reset_password_view($otp,$email)
    {
        $user = GroupMember::where('email',$email)->first();
        if($user){
            if($user->otp==$otp){
                $otp_created_date  = Carbon::parse($user->otp_created_at);
                $otp_expire_date =  Carbon::parse($user->otp_created_at)->addMinute(10);
                if($otp_expire_date >= Carbon::now()){
                    Session::forget('error');
                    return view('password_reset',['id'=>$user->id]);
                }else{
                    Session::put('error', 'Link Expired');
                    return redirect('/');
                }
            }else{
                Session::put('error', 'Invalid OTP');
                return redirect('/');
            }
        }else{
            Session::put('error', 'Invalid Details');
            return redirect('/');
        }
        return $email. ' : '.$otp;
    }

    public function reset_password(Request $request){
        $request->validate([
            'password' => 'required'
        ]);
        $user = GroupMember::find($request->id);
        if($user){
            $user->password = md5($request->password);
            if($user->save()){
                Session::put('error', 'Password Updated');
                return redirect('/');
            }
        }else{
            Session::put('error', 'Something Went Wrong');
            return redirect('/');
        }
    }
}