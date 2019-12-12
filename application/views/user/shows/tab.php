<nav class="navbar navbar-default bg-master-lighter sm-padding-10 full-width p-t-0 p-b-0" role="navigation">
            <div class="container-fluid full-width">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header text-center">
                <button type="button" class="navbar-toggle collapsed btn btn-link no-padding" data-toggle="collapse" data-target="#sub-nav">
                  <i class="pg pg-more v-align-middle"></i>
                </button>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="sub-nav">
                <div class="row">
                <div class="col-sm-4"><ul class="navbar-nav col-sm-12 col-md-12  col-lg-5 ">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-binoculars m-r-10"></i>
<?php
if(isset($tabName)){
	echo $tabName;
}
else{
	echo 'All Shows';
}
?> 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="<?=$_cancel.'/archived'?>">Archived</a>
                          <a class="dropdown-item" href="<?=$_cancel.'/drafts'?>">Drafts</a>
                        </div>
                      </li>
                    </ul></div>
                  
                  <div class="col-sm-4">
<ul class="navbar-nav d-flex flex-row">
<?php
$s_btn = false;
if($user_details->parent_id!=0){
	if($this->data['userPermission']&&(in_array('create_shows',$this->data['userPermission']))){
		$s_btn = true;
	}
}
else{
	$s_btn = true;
}
if($s_btn){
if(isset($channels)){
?>
<li class="nav-item"><a href="<?=$_cancel.'/create_new'?>" data-toggle="tooltip" data-placement="bottom" title="Add New"><i class="fa fa-plus"></i> Add New</a></li>
<!--<li class="nav-item"><a href="<?=$_cancel.'/create/'.$channels->rand_id?>" data-toggle="tooltip" data-placement="bottom" title="Add New"><i class="fa fa-plus"></i></a></li>-->
<?php
}
else{
?>
<li class="nav-item"><a href="<?=$_cancel.'/create_new'?>" data-toggle="tooltip" data-placement="bottom" title="Add New"><i class="fa fa-plus"></i> Add New</a></li>
<?php
}
}
?>                    

</ul>
                    
                  </div>
                  <div class="col-sm-4">
                    <!--<ul class="navbar-nav d-flex flex-row justify-content-sm-end">
                      <li class="nav-item">
                        <a href="#" class="p-r-10"><img width="25" height="25" alt="" class="icon-pdf" data-src-retina="assets/img/invoice/pdf2x.png" data-src="assets/img/invoice/pdf.png" src="assets/img/invoice/pdf2x.png"></a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="p-r-10"><img width="25" height="25" alt="" class="icon-image" data-src-retina="assets/img/invoice/image2x.png" data-src="assets/img/invoice/image.png" src="assets/img/invoice/image2x.png"></a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="p-r-10"><img width="25" height="25" alt="" class="icon-doc" data-src-retina="assets/img/invoice/doc2x.png" data-src="assets/img/invoice/doc.png" src="assets/img/invoice/doc2x.png"></a>
                      </li>
                      <li class="nav-item"><a href="#" class="p-r-10" onclick="$.Pages.setFullScreen(document.querySelector('html'));"><i class="fa fa-expand"></i></a></li>
                    </ul>-->
                  </div>
                </div>
              </div>
              <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
          </nav>
