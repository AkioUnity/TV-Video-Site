<div class="row">
	<div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-body">
<?php echo validation_errors();?>

<?php echo form_open($_cancel.'/order_confirm', array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data",'id'=>'payment-form'))?>
	    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	      	<input type="hidden" name="operation" value="set">
        <fieldset>
<h4>Processing..</h4>
        </fieldset>


    
     <!--<div class="form-actions">
            <div class="row">
                <div class="col-md-9">
                    <?php echo form_submit('submit','Confirm' , 'class="btn btn-primary"')?>
                </div>
            </div>
        </div>-->
 <?php echo form_close()?>
            </div>

    </div>
</div>
</div>
<script>
jQuery(document).ready(function() {
	$( "#payment-form" ).submit();
});
</script>
