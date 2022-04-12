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
								<div class="">{{ $data['subject']}} </div>
								
							</div>
						</div>

						<div class="widget-content" style="margin: 0px;width:100%;">
							
							<div class="table-responsive">
                            @if(Session::has('error'))
                                <span style="color:red;">
                                {{ Session::get('error')}}
                                </span>
                            @endif
                            <div class="col-sm-12">
                                <div class="form-group">
                                    
                                    <div class="col-lg-8">
                                    <label class="control-label" >Groups</label><br/>
                                    @foreach($groups as $lead)
                                    <p>{{ $lead['name']}} </p>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                
                                    <div class="col-lg-8">
                                    <label class="control-label" >To</label><br/>
                                    <p>{{ $data['to_emails']}} </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                
                                    <div class="col-lg-8">
                                    <label class="control-label" >CC</label><br/>
                                    <p>{{ $data['cc_emails']}} </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                
                                    <div class="col-lg-8">
                                    <label class="control-label" >BCC</label><br/>
                                    <p>{{ $data['bcc_emails']}} </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                
                                    <div class="col-lg-8">
                                    <label class="control-label" >Content</label><br/>
                                    <p>{!! $data['body'] !!} </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                
                                    <div class="col-lg-8">
                                    <label class="control-label" >Attachments</label><br/>
                                    @foreach($attachments as $attachment)
                                        <a href="{{ $attachment['path'] }}">{!! $attachment['icon'] !!}</a>
                                        
                                    @endforeach
                                    
                                    </div>
                                </div>
                            </div>
                            

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