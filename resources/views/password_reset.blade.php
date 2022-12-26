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
              <i class="icon-lock"></i> Reset Password
            </div>
            <div class="widget-content">
              <div class="padd">
              @if(Session::has('error'))
              <span style="color:red;">
                {{ Session::get('error')}}
                </span>
              @endif
                
                <!-- Login form -->
                <form class="form-horizontal" action="{{ route('reset_password') }}" method='post'>
                    @csrf <!-- {{ csrf_field() }} -->
                  <!-- Email -->
                  <div class="form-group">
                    <label class="control-label col-lg-4" >New Password</label>
                    <div class="col-lg-8">
                      <input type="password" min='6' name="password" class="form-control" placeholder="New Password" required >
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }} </span>
                        @endif
                    </div>
                  </div>
                  <div class="form-group">
                  </div>
                  <input type="hidden" name="id" value='{{ $id }}'>
                  <div class="col-lg-9 col-lg-offset-3">
                    <button type="submit" class="btn btn-danger btn-lg" style="margin-left:-10px;">Submit</button>
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