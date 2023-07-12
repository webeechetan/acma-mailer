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
								<div class="">Compose Mail Test</div>
								
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
                                        <option value="dg@acma.in">dg@acma.in</option>
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


                            
                            <div class="row">
                                <div class="col-lg-5 pr-lg-2">
                                    <div class="form-group">
                                        <textarea name="footer_left_area" id="footer_left_area" class="form-control" placeholder="Signature">

                                        </textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-2"></div>

                                <div class="col-lg-5 pl-lg-2">
                                    <div class="form-group">
                                        <textarea name="footer_right_area" id="footer_right_area" class="form-control" placeholder="Right Corner">

                                        </textarea>
                                    </div>
                                </div>
                            </div>



                            <!-- Group -->
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <a id="select-files" href="javascript:;" class="btn btn-primary"><i class="fa fa-paperclip"></i> Test Attach Files</a>
                                    <input type="file"  class="attachments" style="display:none;" multiple/>
                                </div>
                            </div>
                            <p>
                                Please make sure the file name does not have any special characters except underscore (for ex: file_name)
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">View Example</a>
                            </p>
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



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Files Example</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p> To ensure that your file can be properly processed and received, please make sure that it has a valid file extension and does not contain any special characters.</p>
        <br>
      <p>To check the file extension, look at the file name and make sure it ends with a valid extension like .jpg, .png, .pdf, etc. If the file does not have a valid extension, please do not attach it to the email.</p>
        <br>
      <p> Additionally, please ensure that the file does not contain any special characters like %, $, &, etc. These characters can cause errors in the email transmission and make it difficult for the recipient to open the file.</p>
        <br>
      <p> Before attaching the file, please also validate the contents of the file to ensure that it meets the required criteria. For example, if you are attaching a text file, make sure it contains only text and not any executable code. Similarly, if you are attaching an image file, make sure it contains only image data and not any malicious code.</p>
      <br>
      <p>
        here are some file name examples that are considered valid and should not cause any issues during the upload or attachment process:
        <ul>
            <li>
                mydocument.docx
            </li>
            <li>
                familyphoto.jpg
            </li>
            <li>
                financialreport.pdf
            </li>
            <li>
                projectpresentation.pptx
            </li>
            <li>
                researchpaper.doc
            </li>
            <li>
                invoice_2022.xlsx
            </li>
            <li>
                vacationvideo.mp4
            </li>
            <li>
                logo.png
            </li>
            <li>
                musictrack.mp3
            </li>
        </ul>
      </p>
      <br>
      <p>
      These file names contain valid file extensions and do not contain any special characters, making them suitable for uploading or attaching to emails. However, it's important to note that these are just examples and the actual file name will depend on the type and purpose of the file being uploaded or attached.
      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> I Understand</button>
      </div>
    </div>
  </div>
</div>
@endsection