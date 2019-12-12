<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
    	        <?php echo validation_errors();?>
			<?=form_open(NULL, array('class' => 'form-horizontal', 'role'=>'form','enctype'=>"multipart/form-data"))?>                              
	    		<div class="form-body">
            		
                    <div class="form-group" >
                  <label class="col-lg-2 control-label"><?=lang('')?>Name</label>
                  <div class="col-lg-10">
                    <?=form_input('name', set_value('name', $news->{'name'}), 'class="form-control " id="" placeholder="name" autofocus')?>
                  </div>
                </div>
                    <h5><?=lang('Translation data')?></h5>
                   <div style="margin-bottom: 0px;" class="tabbable">
                      <ul class="nav nav-tabs">
                        <?php $i=0;
                      //   debugger($this->page_m->languages_icon);
                      //  foreach($this->page_m->languages as $key_lang=>$val_lang):
                        foreach($this->static_text_model->languages_icon as $key_lang=>$val_lang):

                          $i++;?>
                        <li class="<?=$i==1?'active':''?>">
                          <a data-toggle="tab" href="#<?=$key_lang?>"><img src="<?php echo base_url('assets/uploads/language').'/'.$val_lang; ?>" height="15" width="20" ></a></li>
                        <?php endforeach;?>
                      </ul>
                      <div style="padding-top: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                        <?php $i=0;foreach($this->static_text_model->languages as $key_lang=>$val_lang):$i++;?>
                        <div id="<?=$key_lang?>" class="tab-pane <?=$i==1?'active':''?>">
                            <div class="form-group">
                              <label class="col-lg-2 control-label"><?=lang('Title')?></label>
                              <div class="col-lg-10">
                                <?=form_input('title_'.$key_lang, set_value('title_'.$key_lang, $news->{'title_'.$key_lang}), 'class="form-control copy_to_next" id="inputTitle'.$key_lang.'" placeholder="'.lang('Title').'"')?>
                              </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                      </div>
                    </div>
    </div>
                <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-2 col-md-9">
                <?=form_submit('submit', lang('Save'), 'class="btn btn-primary"')?>
                <a href="<?=$_cancel?>" class="btn btn-default" type="button"><?=lang('Cancel')?></a>
                </div>
            </div>
        </div>
            <?=form_close()?>
            </div>
        </div>
    </div>
</div>



