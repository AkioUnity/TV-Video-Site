<!-- <script src="http://www.wiris.net/demo/editor/editor"></script>
    <script>
    var editor;
    window.onload = function () {
      editor = com.wiris.jsEditor.JsEditor.newInstance({'language': 'en'});
            editor.insertInto(document.getElementById('editorContainer'));

editor.setMathML("<math><mfrac><mn>1</mn><mi>x</mi></mfrac></math>");			
    }

var js = document.createElement("script");
js.type = "text/javascript";
js.src = "WIRISplugins.js?viewer=image";
document.head.appendChild(js);
	
    </script>-->
    
<div class="row">
    <div class="col-md-12">
<div id="editorContainer"></div>    
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
                <?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>                        <div class="form-body">
                    
<div class="form-group">
  <label class="col-lg-2 control-label">Title</label>
  <div class="col-lg-10">
<?=form_input('name', set_value('name', $products->{'name'}), 'class="form-control " ')?>

  </div>
</div>                    	

<div class="form-group">
<label class="col-lg-2 control-label"><?=show_static_text($adminLangSession['lang_id'],2067);?>HTML</label>
<div class="col-lg-10">
<a href="javascript:;" onclick="html_preview()" class="btn btn-default">Preview</a> 

<?=form_textarea('html', html_entity_decode(set_value('html', $products->{'html'})), ' class="textarea form-control"')?>

</div>
</div>                        
                           
						</div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text($lang_id,235)?>"><?=show_static_text($lang_id,235)?></button>
                                    <a href="<?=$_cancel;?>" class="btn btn-default" type="button"><?=show_static_text($adminLangSession['lang_id'],22);?></a>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                </div>
                            </div>
                        </div>
				<?=form_close()?>

            </div>
        </div>
        <!-- end panel -->
    </div>
</div>


<link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
<script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {

var IMAGE_PATH = '<?=site_url('assets/uploads/editors/')?>';

$('.textarea').summernote({
    height: 300,
    callbacks : {
        onImageUpload: function(files, editor, welEditable) {
        	sendFile(files[0], editor, welEditable);
				console.log('inok');
		}
    }
});

function sendFile(file, editor, welEditable) {
    data = new FormData();
	data.append('<?=$this->security->get_csrf_token_name();?>','<?=$this->security->get_csrf_hash();?>');
	console.log(file);
	data.append("file", file);
    $.ajax ({
        data:data,
        type: "POST",
        url: "ajax_upoad_img/ajax_upload",
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
			
            var image = IMAGE_PATH + url;
            $('.textarea').summernote('insertImage', image);
			//console.log(image);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

});
</script>

<script>
/*$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});*/
$(document).ready(function () {
    $(".edit-form").submit(function () {
//        $(".submitBtn").attr("disabled", true);
		$(".submitBtn").button('loading');
        return true;
    });
});

function html_preview(){
	checkhtml = $('.textarea').val();
	if(checkhtml!== ''){
		$('#contentarea').html(checkhtml);
	}
	$('#html-editor-modals').modal() ;
}

</script>



<div class="modal fade" id="html-editor-modals" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">Preview</h4>
            </div>
            <div class="modal-body">
<div class="col-md-12">
<div id="contentarea" class="" style="">
</div>
</div>
<div style="clear:both"></div>
			</div>
    </div>

	</div><!--//modal-dialog//-->
</div>

<style>
@media (min-width:992px) {
	.modal-lg {
		width: 1100px;
	}
}
</style>