<script type="text/javascript">
	String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};
	function getParameter(name) {
		var value = new RegExp(name+"=([^&]*)","i").exec(window.location);
		if (value!=null && value.length>1) {
			value = decodeURIComponent(value[1].replace(/\+/g,' '));
		} else {
			value = null;
		}
		return value;
	}
	function insertHtml(content) {
		if (content!=null && content.length>0) {
			document.write(content);
		}
	}
	function setValue(id, content) {
		if (content!=null && content.length>0) {
			document.getElementById(id).value = content;
		}
	}

	var con = new XMLHttpRequest();
	con.open("GET", "tech.txt", false);
	con.send(null);
	var s = con.responseText;
	WIRISplugins_js = "assets/plugins/php-generic_wiris/integration/WIRISplugins.js";
	tech = s.split("#")[0].trim();
	window._wrs_int_path = window._wrs_int_path == null ? "" : window._wrs_int_path;
	if (tech=="php") {
		_wrs_int_conf_file_override = _wrs_int_path > 0 ?
									  _wrs_int_path + "/configurationjs.php" :
									  "integration/configurationjs.php";
	} else if (tech=="aspx") {
		_wrs_int_conf_file_override = _wrs_int_path > 0 ?
									  _wrs_int_path + "/configurationjs.aspx" :
									  "integration/configurationjs.aspx";
	} else if (tech=="local-java") {
		_wrs_int_conf_file_override = "app/configurationjs";
	} else if (tech=="java") {
		_wrs_int_conf_file_override = "/pluginwiris_engineapp/configurationjs";
	} else if (tech=="nodejs") {
		_wrs_int_conf_file_override = "integration/configurationjs";
		WIRISplugins_js = "/integration/WIRISplugins.js";
	}
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = WIRISplugins_js + "?viewer=image";
	document.getElementsByTagName('head')[0].appendChild(script);

	var content = getParameter("content");
</script>
<script type="text/javascript" src="assets/plugins/php-generic_wiris/core/display.js"></script>
<script type="text/javascript" src="assets/plugins/php-generic_wiris/wirisplugin-generic.js"></script>

<script type="text/javascript">
	function wrs_addEvent(element, event, func) {
		if (element.addEventListener) {
			element.addEventListener(event, func, false);
		}
		else if (element.attachEvent) {
			element.attachEvent('on' + event, func);
		}
	}

	wrs_addEvent(window, 'load', function () {
		// Hide the textarea
		var textarea = document.getElementById('example');
		textarea.style.display = 'none';

		// Create the toolbar
		var toolbar = document.createElement('div');
		toolbar.id = textarea.id + '_toolbar';

		// Create the WYSIWYG editor
		var iframe = document.createElement('iframe');
		iframe.id = textarea.id + '_iframe';

		wrs_addEvent(iframe, 'load', function () {
			// Setting design mode ON
			iframe.contentWindow.document.designMode = 'on';

			// Setting the content
			if (iframe.contentWindow.document.body) {
				iframe.contentWindow.document.body.innerHTML = textarea.value;

				// WE INIT THE WIRIS PLUGIN HERE
				wrs_int_init(iframe,toolbar);
			}
		});

		// We set an empty document instead of about:blank for use relative paths for images
		iframe.src = 'assets/plugins/php-generic_wiris/tests/generic_demo.html';
		iframe.width = 500;
		iframe.height = 200;

		// Insert the WYSIWYG editor before the textarea
		textarea.parentNode.insertBefore(iframe, textarea);

		// Insert the toolbar before the WYSIWYG editor
		iframe.parentNode.insertBefore(toolbar, iframe);

		// When the user submits the form, set the textarea value with the WYSIWYG editor content
		var form = document.getElementById('exampleForm');

		wrs_addEvent(form, 'submit', function () {
			// Set the textarea content and call "wrs_endParse"
			textarea.value = wrs_endParse(iframe.contentWindow.document.body.innerHTML);
		});
	});

	function changeDPI() {
		ls = document.getElementsByClassName('Wirisformula');
		for (i=0;i<ls.length;i++) {
			img = ls[i];
			img.width = img.clientWidth;
			img.src = img.src + "&dpi=600";
		}
	}
</script>



<form id="exampleForm" method="GET">
<textarea id="example" name="content" cols="50" rows="10"><!-- content value --></textarea>
<br />
<script>setValue("example",content);</script>

<input id="previewButton" type="submit" value="Preview"/>
</form>

<h2>Preview</h2>

<div id="previewBox">
    <script>insertHtml(content);</script>
</div>

<script>
    var value = document.getElementById("example").value;
    if (value.length==0 || value=="<!-- content "+"value -->") {
        document.getElementById("previewBox").innerHTML = '<span id="previewMessage">Press the "Preview" button.</span>';
    }
</script>

<!--
 <script src="http://www.wiris.net/demo/editor/editor"></script>
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
<a href="javascript:;" onClick="html_preview()" class="btn btn-default">Preview</a> 

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
	$('.textarea').summernote({height: 300});
</script>

<script>
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
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