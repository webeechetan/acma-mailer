@extends('layouts.master')
@section('content')
<div class="mainbar">
<div role="alert" class="alert alert-success" id="success-alert" style="display:none;">
	<button type="button" class="close" data-dismiss="alert">x</button>
	<strong>Success! </strong><span id="msg-alert">Product have added to your wishlist.</span>
</div>
	<div class="matter">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget">
						<div class="widget-head">
							<div class="col-md-12">
								<div class="">Users</div>
								<div class="widget-icons pull-right">
									<a href="#" class="wminimize"></a>
								</div>
							</div>
							<form id="search-form">
							<div class="row">
								<div class="col-md-7">
									<div class="form-group col-md-4">
										<input name="text_search" type="text" placeholder="Enter Name" class="form-control">
									</div>
									<div class="form-group col-md-4">
									<input id="useremail" name="useremail" type="text" placeholder="Enter Email" class="form-control" autocomplet="off">
									</div>

									<div class="form-group col-md-4">
                                    	<input name="added_on" id="added_on" type="text" placeholder="Select Date" class="form-control" style="cursor:pointer;">
									</div>
									<div class="form-group col-md-4">
									<select name="email" id="email" class="form-control">
										<option value="">Select User</option>
										<?php if(isset($leads) && !empty($leads)) { 
											foreach($leads as $key=>$user){ ?>
												<option value="<?php echo $user['id'];?>">
												<?php echo $user['email'].' - '.$user['receipt'];?>
											</option>
											<?php }
									} ?>
									</select>
                                   
								</div>
								<div class="form-group col-md-4">
									<select name="prize" id="prize" class="form-control">
										<option value="">Select Prize</option>
										<option value="1">New Moon Abalone</option>
										<option value="2">New Moon Bird's Nest Drink</option>
									</select>
								</div>
								</div>
								<div class="col-md-5">
									<div class="col-md-4">
										<input type="hidden" name="page" value="1" id="page">
										<input type="hidden" name="sorting_order" value="" id="sorting_order">
										<input type="hidden" name="sorting_column" value="" id="sorting_column">
										<input type="submit" value="Search" class="btn btn-primary pull-left btn-block" id="submit_search_btn">
									</div>
									<div class="col-md-4">
										<input type="reset" value="Reset" class="btn btn-primary pull-left btn-block" id="reset_btn">
									</div>
									<div class="col-md-4">
									<input type="button" value="Download CSV" id="submit_download_csv" class="btn btn-primary pull-left btn-block">
									</div>
								</div>
							</div>
							
							</form>
						</div>

						<div class="widget-content" style="margin: 0px;width:100%;">
							
							<div class="table-responsive">
								<table id="datatable" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Id <a href="javacsript:;" class="sorting" column="id" style="float:right;"><i class="fa fa-fw fa-sort"></i></a></th>
											<th>Name <a href="javacsript:;" class="sorting" column="name" style="float:right;"><i class="fa fa-fw fa-sort"></i></a></th>
											<th>Email<a href="javacsript:;" class="sorting" column="email" style="float:right;"><i class="fa fa-fw fa-sort"></i></a></th>
											<th>Receipt No. <a href="javacsript:;" class="sorting" column="receipt" style="float:right;"><i class="fa fa-fw fa-sort"></i></a></th>
											<th>Purchase Date</th>
											<th>Played on</th>
											<th>Prize</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

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