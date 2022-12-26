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
								<div class="">All Contacts</div>
								<div class="pull-right download-icon" >
									<a href="{{ env('APP_URL') }}create-group-user" class="wminimize" ><i class="fa fa-plus" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>

						<div class="widget-content" style="margin: 0px;width:100%;">
							
							<div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											
											<th>Email </th>
											<th>Group</th>
                                            <th>Modified At</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($data as $lead)
                                        @php
                                        $groupname = ''
                                        @endphp 
                                        @foreach($lead['user_group'] as $group)
                                           @php $groupname .= $group['group']['name'].',' @endphp
                                        @endforeach
                                        <tr>
                                            <td>{{ $lead['email'] }}</td>
                                            <td>{{ $groupname }}</td>
                                            <td>{{ $lead['created_at'] }}</td>
											<td>
												<a href="/delete-group-member/{{ $lead['id'] }}" class="btn btn-danger" >Delete</a>
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
@endsection