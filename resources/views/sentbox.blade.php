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
								<div class="">Sent Mails</div>
								<div class="pull-right download-icon" >
									<a href="{{ env('APP_URL') }}compose" class="wminimize" ><i class="fa fa-plus" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>

						<div class="widget-content" style="margin: 0px;width:100%;">
							
							<div class="table-responsive">
                                
								<table id="datatable" class="table table-inbox   table-hover">
									<thead>
										<tr>
											<th>Id </th>
											<th>Groups </th>
											<th>To </th>
											<th>Subject</th>
											<th>Body</th>
											<th>Sent On</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($data as $lead)
                                        <tr class="mail-detail" id="{{ $lead['id'] }}" style="cursor:poniter;">
											<td>{{ $lead['id'] }}</td>
											<td>
											@php
											$groupname = '';
											@endphp 
											@if(isset($lead['groups']) && !empty($lead['groups']))
												@foreach($lead['groups'] as $group)
												@php $groupname .= $group['name'].', ' @endphp
												@endforeach
											@endif
											{{ $groupname }}
											</td>
                                            <td >{!! Str::limit($lead['to_emails'], 50, ' ...') !!}</td>
                                            <td>{{ $lead['subject'] }}</td>
                                            <th>
												<button data-body="{{ $lead['body'] }}"   type="button" class="btn btn-primary" id="view_body" onclick="display_message(this)" data-toggle="modal" data-target="#exampleModalLong">
													View Body
												</button>
												<hr>
												<a href="{{ route('compose',$lead['id']) }}"><button class="btn btn-primary">Use Format</button>
                                            </th>
											
                                            <td>
                                                {{ $lead['created_at'] }}
                                                @if ($lead['attachments'] != '')
                                                <i style="float:right;" class="fa fa-paperclip"></i>
                                                @endif
                                            </td>
											
                                        </tr>
                                    
                                    @endforeach
									</tbody>
								</table>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mail Body</h5>
      </div>
      <div class="modal-body" id="mail_body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

<script>
    
    function display_message(data){
        document.getElementById("mail_body").innerHTML= data.getAttribute('data-body');
    }
</script>