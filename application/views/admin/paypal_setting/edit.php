<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
            <?php echo validation_errors();?>
                 <?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>
                        <div class="form-body">
<div class="form-group" >
	<label class="col-md-2 control-label">Username</label>
	<div class="col-md-10">
<?=form_input('username', set_value('username', $paypal->username), 'class="form-control " required')?>
	</div>
</div>                           
<div class="form-group" >
	<label class="col-md-2 control-label">Signature</label>
	<div class="col-md-10">
<?=form_input('signature', set_value('signature', $paypal->signature), 'class="form-control " required')?>
	</div>
</div>                           
<div class="form-group" >
	<label class="col-md-2 control-label">Password</label>
	<div class="col-md-10">
<?=form_input('password', set_value('password', $paypal->password), 'class="form-control " required')?>
	</div>
</div>                           
<div class="form-group" >
	<label class="col-md-2 control-label">Sandbox</label>
	<div class="col-md-10">
<?=form_checkbox('sandbox', '1', set_value('sandbox', $paypal->sandbox), 'id="inputDefault" class=""')?>
	</div>
</div>                           

						</div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-9">
                                    <?=form_submit('submit', 'Update', 'class="btn btn-primary"')?>
                                    <!--<button type="button" class="btn default">Cancl</button>-->
                                </div>
                            </div>
                        </div>
                    <?=form_close()?>

            </div>
        </div>
    </div>
</div>
