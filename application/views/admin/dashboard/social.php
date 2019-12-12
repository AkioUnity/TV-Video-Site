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
                            <label class="col-lg-3 control-label">Facebook Url</label>
                            <div class="col-lg-9">
                               <?=form_input('facebook_url', set_value('facebook_url', isset($settings['facebook_url'])?$settings['facebook_url']:''), 'class="form-control" id="facebook_url" placeholder="Facebook Url"')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Twitter Url</label>
                            <div class="col-lg-9">
                              <?=form_input('twitter_url', set_value('twitter_url', isset($settings['twitter_url'])?$settings['twitter_url']:''), 'class="form-control" id="twitter_url" placeholder="Twitter Uurl"')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Youtube Url</label>
                            <div class="col-lg-9">
                              <?=form_input('youtube_url', set_value('youtube_url', isset($settings['youtube_url'])?$settings['youtube_url']:''), 'class="form-control" id="youtube_url" placeholder="Youtube Url"')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Linkedin Url</label>
                            <div class="col-lg-9">
                              <?=form_input('linkedin_url', set_value('linkedin_url',isset($settings['linkedin_url'])?$settings['linkedin_url']:''), 'class="form-control" id="linkedin_url" placeholder="Linkedin Url"')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Google Plus</label>
                            <div class="col-lg-9">
                              <?=form_input('google_plus', set_value('google_plus',isset($settings['google_plus'])?$settings['google_plus']:''), 'class="form-control" id="google_plus" placeholder="Google Plus"')?>
                            </div>
                        </div>
                                                
                        
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Instagram</label>
                            <div class="col-lg-9">
                              <?=form_input('instagram_url', set_value('instagram_url',isset($settings['instagram_url'])?$settings['instagram_url']:''), 'class="form-control" id="google_plus" placeholder="instagram"')?>
                            </div>
                        </div>

                    
                    
                    
                    
                    <?php /*?><div class="form-group">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-4">
<?php
if(!empty($setting[7]->value)){
	$image='assets/uploads/coupons/small/'.$edit_data->image;
  	echo '<img alt="'.$edit_data->coupon_title.'" src="'.$image.'" class="img-rounded">';
}
?>
							<input type='file' name="photo" />                            
                        </div>
                    </div>
                    </div><?php */?>
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

