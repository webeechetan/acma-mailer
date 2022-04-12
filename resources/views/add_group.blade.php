@extends('layouts.master')
@section('content')
<div class="mainbar">
	<div class="matter">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-head">
							<div class="col-md-12">
								<div class="">Create Group</div>
								
							</div>
						</div>

						<div class="widget-content" style="margin: 0px;width:100%;">
							
							<div class="table-responsive">
                            @if(Session::has('error'))
                            <span style="color:red;">
                                {{ Session::get('error')}}
                                </span>
                            @endif

                            <!-- Login form -->
                            <form class="form-horizontal" action='' method='post'>
                                @csrf <!-- {{ csrf_field() }} -->
                            <!-- Email -->
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="inputName">Group Name</label>
                                <div class="col-lg-4">
                                <input type="text" name="name" class="form-control" id="inputName" placeholder="Group Name" required>
                                </div>
                            </div>
                            <!-- Password -->
                            <!-- <div class="form-group">
                                <label class="control-label col-lg-3" for="inputPassword">Code</label>
                                <div class="col-lg-4">
                                <input type="text" name="code" class="form-control" id="inputCode" placeholder="Code" required>
                                </div>
                            </div> -->
                            
                            <div class="col-lg-9 col-lg-offset-3">
                                <button type="submit" class="btn btn-danger btn-lg" style="margin-left:-10px;">Add</button>
                            </div>

                            <br />
                            <br />
                            </form>

                            <div class="clearfix"></div>
							</div>
							<div class="widget-foot">
								<br><br>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

</div>
@endsection