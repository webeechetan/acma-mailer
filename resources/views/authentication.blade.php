@extends('layouts.master')
@section('content')
<!-- Form area -->
<div class="admin-form">
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <!-- Widget starts -->
          <div class="widget login">
            <!-- Widget head -->
            <div class="widget-head">
              <i class="icon-lock"></i> OTP Verification
            </div>
            <div class="widget-content">
              <div class="padd">
              @if(Session::has('error'))
              <span style="color:red;">
                {{ Session::get('error')}}
                </span>
              @endif
                
                <!-- Login form -->
                <form class="form-horizontal" action='' method='post'>
                    @csrf <!-- {{ csrf_field() }} -->
                  
                  <!-- Password -->
                  <div class="form-group">
                    <label class="control-label col-lg-3" for="inputOTP">OTP</label>
                    <div class="col-lg-8">
                      <input type="password" name="otp" class="form-control" id="inputOTP" placeholder="Enter OTP" required>
                    </div>
                  </div>
                  <div class="form-group">
                  </div>
                  <div class="col-lg-9 col-lg-offset-3">
                    <button type="submit" class="btn btn-danger btn-lg" style="margin-left:-10px;">Verify</button>
                    <div style="float:right;display:none;"><a href="">Forgot Password?</a></div>
                  </div>

                  <br />
                  <br />
                </form>

                <div class="clearfix"></div>
              </div>

            </div>

            <div class="widget-foot">
              <center><font color="red" size="2px"></font></center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection