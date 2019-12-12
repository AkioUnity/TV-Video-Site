<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th><?=show_static_text($adminLangSession['lang_id'],244);?></th>
                        <th><?=show_static_text($adminLangSession['lang_id'],16);?></th>
                        <th><?=show_static_text($adminLangSession['lang_id'],255);?></th>
                        <th><?=show_static_text($adminLangSession['lang_id'],156);?></th>
                    </tr>
                </thead>
                <tbody>
                <!-- Start: list_row -->
    <?php
    if(count($all_data)){
		$i=0;
    foreach($all_data as $set_data){
		$i++;
    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $set_data->name;?></td>
                        <td><?php echo $set_data->subject;?></td>
                        <td>
    <a class="btn btn-icon-only btn-info" href="<?=$_cancel.'/edit/'.$set_data->id;?>"><i class="fa fa-edit"></i></a>
    
                        </td>
                    </tr>
    
    <?php             
    }
    }
    ?>                        
                <!-- End: list_row -->
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>

