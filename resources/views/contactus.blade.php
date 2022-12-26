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
								<div class="">Contact Us - Users</div>
								<div class="pull-right download-icon" >
									<a href="{{ env('APP_URL') }}downloadContactLeads" class="wminimize" ><i class="fa fa-download" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>

						<div class="widget-content" style="margin: 0px;width:100%;">
							
							<div class="table-responsive">
								<table id="datatable" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											
											<th>Name </th>
											<th>Email</th>
											<th>Phone</th>
											<th>Message</th>
											<th>UTM Source</th>
											<th>UTM Medium</th>
											<th>UTM Campaign</th>
											<th>UTM Term</th>
											<th>UTM Content</th>
											<th>Created On</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($data as $lead)
                                        <tr>
                                            <td>{{ $lead['name'] }}</td>
                                            <td>{{ $lead['email'] }}</td>
                                            <td>{{ $lead['phone'] }}</td>
                                            <td>{{ $lead['message'] }}</td>
											<td>{{ isset($lead['utm']['utm_source'])?$lead['utm']['utm_source']:'' }}</td>
											<td>{{ isset($lead['utm']['utm_medium'])?$lead['utm']['utm_medium']:'' }}</td>
											<td>{{ isset($lead['utm']['utm_campaign'])?$lead['utm']['utm_campaign']:'' }}</td>
											<td>{{ isset($lead['utm']['utm_term'])?$lead['utm']['utm_term']:''}}</td>
											<td>{{ isset($lead['utm']['utm_content'])?$lead['utm']['utm_content']:'' }}</td>
                                            <td>{{ $lead['created_at'] }}</td>
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
@endsection