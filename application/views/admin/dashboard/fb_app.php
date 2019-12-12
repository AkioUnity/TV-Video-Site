<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
				<?php echo validation_errors(); ?>
            	<form class="form-horizontal" role="form" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="form-body">	                    
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Facebook App</label>
                            <div class="col-lg-9">
                               <?=form_input('fb_app', set_value('fb_app', isset($settings['fb_app'])?$settings['fb_app']:''), 'class="form-control" required')?>
                            </div>
                        </div>
                </div>
                    
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-primary btn-label-left">
                            <?php echo $this->lang->line('submit');?></button>
                        </div>
                    </div>
				</div>                    
            </form>
            </div>
        </div>
    </div>
</div>

