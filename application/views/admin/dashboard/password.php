<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
                <?php echo validation_errors(); ?>
                <form class="form-horizontal" role="form" method="post">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],51);?></label>
                            <div class="col-sm-4">
                                <input type="password" name="old_password" class="form-control" placeholder="Old password" value="<?php echo set_value('old_password');?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],161);?></label>
                            <div class="col-sm-4">
                                <input type="password" name="password" class="form-control" placeholder="New Password" value="<?php echo set_value('password');?>" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?=show_static_text($adminLangSession['lang_id'],256);?></label>
                            <div class="col-sm-4">
                                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm" value="<?php echo set_value('password_confirm');?>" >
                            </div>
                        </div>
                    </div>                    
                    
	                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary btn-label-left"><?=show_static_text($adminLangSession['lang_id'],4);?></button>
                            <!--<button type="button" class="btn default">Cancl</button>-->
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
