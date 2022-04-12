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
								<div class="">Create Group Users</div>
								
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
                            <form class="form-horizontal" action='' method='post' enctype="multipart/form-data">
                                @csrf <!-- {{ csrf_field() }} -->
                            <!-- Email -->
                            <div class="form-group">
                                <label class="control-label col-lg-3" for="inputName">File</label>
                                <div class="col-lg-4">
                                <input type="file" name="csv" class="form-control" id="inputName" placeholder="Name" required>
                                </div>
                            </div>
                           
                            <!--<div class="form-group">
                                <label class="control-label col-lg-3" for="inputPassword">Choose Group</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="group_id" required>
                                        @foreach($data as $lead)
                                            <option value="{{ $lead['id'] }}">{{ $lead['name'] }} - {{ $lead['code'] }}</option>
                                           
                                        @endforeach
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-lg-9 col-lg-offset-3">
                                <input type="hidden" name="created_by" value="{{ $created_by}}">
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