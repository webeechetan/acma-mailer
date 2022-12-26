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
								<div class="">Compose Mail</div>
								
							</div>
						</div>

						<div class="widget-content">
							
							<div class="table-responsive">
                            @if(Session::has('error'))
                            <span style="color:red;">
                                {{ Session::get('error')}}
                                </span>
                            @endif

                            <!-- Login form -->
                            <form class="form-horizontal" action='/sendEmail' method='post' enctype="multipart/form-data">
                                @csrf <!-- {{ csrf_field() }} -->
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label ><strong>FROM</strong></label><br/>
                                    <select class="form-control" name="from_email">
                                        <option value="acma@acma.in">acma@acma.in</option>
                                        <option value="finance@acma.in">finance@acma.in</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <div class="col-lg-12">
                                <label ><strong>Select Mail List</strong></label><br/>
                                   <div class="check_box">
                                   <label><input type="checkbox" value="all" id="all_groups"> All Groups</label>
                                        @foreach($data as $lead)
                                        <label><input class="groups" type="checkbox" name="group_ids[]" value="{{ $lead['id'] }}"> {{ $lead['name'] }}</label>
                                        @endforeach
                                        <!-- <select class="form-control" name="group_ids[]" id="group_id" multiple required>
                                            <option value="">Select Mail List</option>
                                            @foreach($data as $lead)
                                                <option value="{{ $lead['id'] }}">{{ $lead['name'] }}</option>
                                            @endforeach
                                    </select> -->
                                   </div>
                                </div>
                            </div>
                            
                            <div class="form-group" style="display:none;">
                                <div class="col-lg-12">
                                <input type="hidden" name="to_emails" class="form-control" id="to_emails" placeholder="To" data-role="tagsinput">
                                </div>
                            </div>
                            
                            <!--<div class="form-group">-->
                            <!--    <div class="col-lg-8">-->
                            <!--    <input type="text" name="cc_emails" class="form-control" id="cc_emails" data-role="tagsinput" placeholder="CC">-->
                            <!--    </div>-->
                            <!--</div>-->

                            <!--<div class="form-group">-->
                            <!--    <div class="col-lg-8">-->
                            <!--    <input type="text" name="bcc_emails" class="form-control" id="bcc_emails" data-role="tagsinput" placeholder="BCC">-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="form-group">
                                <div class="col-lg-12">
                                <input type="text" name="subject" class="form-control " id="subject" placeholder="Subject" required>
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <textarea name="body" id="msg-body" class="form-control " placeholder="Write Something here..">
                                        @if($format)
                                            {{ $format->body }}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                            <!-- Group -->
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <a id="select-files" href="javascript:;" class="btn btn-primary"><i class="fa fa-paperclip"></i> Attach Files</a>
                                    <input type="file"  class="attachments" style="display:none;" multiple/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4" id="filename">
                                    
                                </div>
                                <div class="col-lg-4" id="deleted-files">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-4">
                                    <button style="width:30%" type="submit" class="btn btn-danger btn-lg" ><i class="fa fa-paper-plane"></i> Send</button>
                                </div>
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