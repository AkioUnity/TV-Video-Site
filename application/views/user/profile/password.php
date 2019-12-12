<div class="row">
<div class="col-md-12">
<!-- begin panel -->
<div data-sortable-id="form-stuff-1" class="panel panel-inverse">
    <div class="panel-heading">                
        <h4 class="panel-title"><?=$name?></h4>
    </div>
    <div class="panel-body">
        <?php echo validation_errors(); ?>
        <form class="form-horizontal" role="form" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="form-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?=show_static_text(1,51);?></label>
                    <div class="col-sm-4">
                        <input type="password" name="old_password" class="form-control" placeholder="Old password" value="<?php echo set_value('old_password');?>" >
                        <span class="error-span"><?php echo form_error('old_password'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?=show_static_text(1,161);?></label>
                    <div class="col-sm-4">
                        <input type="password" name="password" class="form-control" placeholder="New Password" value="<?php echo set_value('password');?>" >
                        <span class="error-span"><?php echo form_error('password'); ?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?=show_static_text(1,256);?></label>
                    <div class="col-sm-4">
                        <input type="password" name="password_confirm" class="form-control" placeholder="Confirm" value="<?php echo set_value('password_confirm');?>" >
                        <span class="error-span"><?php echo form_error('password_confirm'); ?></span>
                    </div>
                </div>
            </div>                    
            
            <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                    <button type="submit" class="btn btn-primary btn-label-left"><?=show_static_text(1,4);?></button>
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
