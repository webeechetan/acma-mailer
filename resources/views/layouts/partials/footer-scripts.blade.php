<!-- core JavaScript files
================================================= -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- JS -->
<script src="{{ env('APP_URL') }}assets/js/jquery.js"></script> <!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
<script src="{{ env('APP_URL') }}assets/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="{{ env('APP_URL') }}assets/js/bootstrap-tagsinput.js"></script> <!-- Bootstrap -->
<!-- <script src="{{ env('APP_URL') }}assets/js/summernote-bs4.min.js"></script> Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<Script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/js/summernote-cleaner.js') }}"></script>
<!--<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>-->

<script>
$(document).ready( function(){
    $('#nav li a').click(function() {
    $('li a').removeClass("currunt");
    $(this).addClass("currunt");
    localStorage.setItem('active', $(this).parent().index());
    });

    var ele = localStorage.getItem('active');
    $('#nav li:eq(' + ele + ')').find('a').addClass('currunt');
});
$(document).ready( function () {
    $('#datatable').DataTable({
        order: [[1, 'desc']],
    });
    
    if($('#msg-body').length) {
        $('#msg-body').summernote({
            height: 600,
            placeholder: "Write Something here..",
            onImageUpload: function(files, editor, welEditable) {
            //   sendFile(files[0], editor, welEditable);
                console.log("file in summer editor", files)
            },
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough','clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph','height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link','picture'] ],
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    shouldChangeEmail = false;
                    emailContent = contents;
                    //console.log('onChange:', contents, $editable);
                },
                onInit:function() {
                    $(".note-icon-picture").on('click',function () {
                        setTimeout(()=>{$(".modal-backdrop").css({"z-index": "49" })}, 1000);
                    });
                } 
            }
        });

    }
    
    // CKEDITOR.replace('msg-body');
});

$(document).on('click', '#select-files', function(){
    document.getElementsByClassName("attachments")[0].click();
});
/*
var finalFiles = {};
var fileList =[];
$(document).on('change', '#attachments', function(e) {
    finalFiles = {};
    $('#filename').html("");
    var fileNum = this.files.length,
      initial = 0,
      counter = 0;

    $.each(this.files,function(idx,elm){
       finalFiles[idx]=elm;
    });

    for (initial; initial < fileNum; initial++) {
      counter = counter + 1;
      fileList.push(this.files[initial]);

      //$('#filename').append('<div id="file_'+ initial +'"><span class="fa-stack fa-lg"><i class="fa fa-file fa-stack-1x "></i><strong class="fa-stack-1x" style="color:#FFF; font-size:12px; margin-top:2px;">' + counter + '</strong></span> ' + this.files[initial].name + '&nbsp;&nbsp;<span class="fa fa-times-circle fa-lg closeBtn" onclick="removeLine(this)" title="remove"></span></div>');
    }
    counter =0;
    for(i=0;i<fileList.length;i++)
    {
        counter = counter + 1;
       // $('#attachment').append('<input type="file" value="'+fileList[i]+'" id="attachments'+i+'"  name="attachments[]" style="display:none;" multiple/>')
        $('#filename').append('<div id="file_'+ i +'"><span class="fa-stack fa-lg"><i class="fa fa-file fa-stack-1x "></i><strong class="fa-stack-1x" style="color:#FFF; font-size:12px; margin-top:2px;">' + counter + '</strong></span> ' + fileList[i].name + '&nbsp;&nbsp;<span class="fa fa-times-circle fa-lg closeBtn" onclick="removeLine(this)" title="remove"></span></div>');
    }
});


function removeLine(obj)
{
  //inputFile.val('');
  var jqObj = $(obj);
  var container = jqObj.closest('div');
  var index = container.attr("id").split('_')[1];
  container.remove(); 
  $('#deleted-files').append('<input type="hidden" name="deleted[]" value="'+finalFiles[index].name+'">');
  delete finalFiles[index];
  //console.log(finalFiles);
}
*/
document.getElementsByClassName("attachments")[0].addEventListener("change", () => {
    insertFile();
});
function insertFile() {
    const files = document.getElementsByClassName("attachments")[0].files;
    for(let i = 0; i < files.length; i++) {
        $('#filename').append('<div><span class="fa-stack fa-lg"><i class="fa fa-file fa-stack-1x "></i><strong class="fa-stack-1x images-counter" style="color:#FFF; font-size:12px; margin-top:2px;"></strong></span> ' + files[i].name + '&nbsp;&nbsp;<span class="fa fa-times-circle fa-lg closeBtn" onclick="removeinsertedLine(this)" title="remove"><input type="hidden" name="selectedfile[]" value="'+files[i].name+'"></span>');
    }
    $(".attachments:first").clone().appendTo("#filename");
    $(".attachments:last").attr("name","attachments[]");
    
    const counterClass = document.getElementsByClassName("images-counter");
    for(let i = 0; i < counterClass.length; i++) {
        counterClass[i].innerHTML = i + 1;
    }
}

function removeinsertedLine(e) {
    $(e).parent().remove();
}


$(document).on('click', '.mail-detail', function(){
    var id = $(this).attr('id');
    window.location.href = "/mail/"+id; 
})

$(document).on('click','#upload_csv',function(){
	$('#upload_csv_file').trigger('click');

});
$(document).on('change','#upload_csv_file',function(e){
    var filename	=	$('input[type=file]')[0].files[0].name;
    extension 	=	filename.split('.');
    if(extension[1]=='csv' || extension[1]=='CSV'){
        $('#upload_submit_btn').trigger('click');
    }else{
        alert('Please upload .csv file');
    }

});
$(document).on('change', '#group_id', function(){
    var values = $(this).val();
    console.log(values);
    $.ajax({
        url:"get-group-users",
        method: 'post',
        data:{group_ids: JSON.stringify(values), "_token": "{{ csrf_token() }}"},
        success: function(res){
            var result = JSON.parse(res);
            // if(result.users){
            //     for(i in result.users) {
            //         $('#to_emails').tagsinput('add', result.users[i]);
            //         $('#to_emails').tagsinput('refresh');
            //     }
                
            // }

        }
    })
});
$(document).on('click', '#all_groups', function() {
    if($(this).is(":checked")) {
        $('.groups').prop('checked', true);
    } else {
        $('.groups').prop('checked', false);
    }
});
</script>