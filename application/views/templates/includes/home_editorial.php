<?php
$this->db->limit(9);
$home_featured = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Editorial','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));
//printR($home_featured);
$this->db->limit(9,9);
$home_featured_2 = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Editorial','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));

$this->db->limit(9,18);
$home_featured_3 = $this->comman_model->get_by('news',array('enabled'=>1,'section'=>'Editorial','s_date <='=>date('Y-m-d'),'e_date >='=>date('Y-m-d')),array('id'=>'desc'));
if($home_featured||$home_featured_2||$home_featured_3){
?>

<a href="category/Editorial"><h2 class="block-title mt8" data-title="Editorial">
Editorial 
<!--			<a href="#" class="category-more text-right">Continue to the category <img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>-->
</h2></a>

		<div class="article-carousel boxed en-block category-block wide-space color-1 mb5">
			
			<div class="swiper-container carousel-container">
			    <div class="swiper-wrapper">
<?php
if($home_featured){
?>
<div class="swiper-slide">
<div class="row">
    <div class="col-sm-6 col-md-3">
<?php
$n_i= 0;
foreach($home_featured as $set_news){
	$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
	if($user_data){
		$n_i++;
		if($n_i>=4){
			break;
		}

		$html = strip_tags($set_news->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html,20);
		
?>
<div class="post hover-light">
<div class="meta inline-meta small-meta">
<div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>"></div>
<span class="author"><?=$set_news->name?></span>
<br>
<span class="date"><?=date("d M 'y",$set_news->created)?></span>
</div>
<div class="border-bottom2 mb2 color-1"></div>
<p><a href="news/v/<?=$set_news->id?>" ><?=$new_html?></a></p>

</div>
<?php
	}
}
?>
                        </div>
                        <!-- /.col -->
    
    <div class="col-sm-6 col-md-3">

<?php
$n_i= 0;
$skip_i = 0;
foreach($home_featured as $set_news){
	$skip_i++;
	if($skip_i>3){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			$n_i++;
			if($n_i>=4){
				break;
			}
			$html = strip_tags($set_news->description);
			$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
			$new_html = word_limiter($html, 20);
			
?>
<div class="post hover-light">
<div class="meta inline-meta small-meta">
<div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>"></div>
<span class="author"><?=$set_news->name?></span>
<br>
<span class="date"><?=date("d M 'y",$set_news->created)?></span>
</div>
<div class="border-bottom2 mb2 color-1"></div>
<p><a href="news/v/<?=$set_news->id?>" ><?=$new_html?></a></p>
</div>
<?php
		}
	}
}
?>
    </div>
    <!-- /.col -->
    
    <div class="col-md-6">
<?php
$newsArr= array();
$home_editorial_newsTitle = '';
if(isset($home_featured[6])){
	$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured[6]->author_id),false,true);
	if($user_data){
		$html = strip_tags($home_featured[6]->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$newsArr['text'] = word_limiter($html, 100);
		$newsArr['user_data'] = $user_data;
		$newsArr['data'] = $home_featured[6];
	}
}
if($newsArr){
?>
        <div class="post first hover-dark">
            <a href="news/v/<?=$newsArr['data']->id?>">
                <div class="image" data-src="<?=!empty($newsArr['data']->image)?'assets/uploads/news/full/'.$newsArr['data']->image:'assets/uploads/no-image.gif'?>">
                    <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                </div>
            </a>
        </div>
<?php
}
?>
        <div class="row">
<?php
if($newsArr){
?>
        
            <div class="col-md-7">
                <div class="post hover-light">
                    <h4><a href="news/v/<?=$newsArr['data']->id?>"><?=$newsArr['data']->name?></a></h4>
                    <p><?=$newsArr['text']?></p>
                </div>            
            </div>
<?php
}
?>            
<?php
if(isset($home_featured[7])){
	$userName = '';
	$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured[7]->author_id),false,true);
	if($user_data){
		$userName = $user_data->name;
	}
?>
    <div class="col-md-5">

        <div class="post hover-light color-3">
<?php
if(!empty($home_featured[7]->label)){
?>
<div class="meta">
<a href="news/v/<?=$home_featured[7]->id?>" class="label bgred"><?=$home_featured[7]->label?></a>
</div>
<?php
}
?>                    
            <p><?=$home_featured[7]->name?></p>
            <div class="meta inline-meta small-meta">
                <span class="author"><?=$userName?></span>
                <span class="date"><?=date("d M 'y",$set_news->created)?></span>
            </div>
        </div>

<?php
if(isset($home_featured[8])){
$userName = '';
$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured[8]->author_id),false,true);
if($user_data){
$userName = $user_data->name;
}
?>

        <div class="post hover-light">
<?php
if(!empty($home_featured[8]->label)){
?>
<div class="meta">
<a href="news/v/<?=$home_featured[8]->id?>" class="label bgred"><?=$home_featured[8]->label?></a>
</div>
<?php
}
?>                    
            <p><?=$home_featured[8]->name?></p>
            <div class="meta inline-meta small-meta">
                <span class="author"><?=$userName?></span>
                <span class="date"><?=date("d M 'y",$set_news->created)?></span>
            </div>
        </div>
<?php
}
?>                
        
    </div>
<?php
}
?>            
        </div>

        <!-- /.row -->
        
    </div>
        <!-- /.col -->
        
    </div>
    <!-- /.row -->
</div>
<?php
}
if($home_featured_2){
?>
<div class="swiper-slide">
<div class="row">
    <div class="col-sm-6 col-md-3">
<?php
$n_i= 0;
foreach($home_featured_2 as $set_news){
	$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
	if($user_data){
		$n_i++;
		if($n_i>=4){
			break;
		}

		$html = strip_tags($set_news->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 20);
		
?>
<div class="post hover-light">
<div class="meta inline-meta small-meta">
<div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>"></div>
<span class="author"><?=$set_news->name?></span>
<br>
<span class="date"><?=date("d M 'y",$set_news->created)?></span>
</div>
<div class="border-bottom2 mb2 color-1"></div>
<p><a href="news/v/<?=$set_news->id?>" ><?=$new_html?></a></p>

</div>
<?php
	}
}
?>
                        </div>
                        <!-- /.col -->
    
    <div class="col-sm-6 col-md-3">

<?php
$n_i= 0;
$skip_i = 0;
foreach($home_featured_2 as $set_news){
	$skip_i++;
	if($skip_i>3){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			$n_i++;
			if($n_i>=4){
				break;
			}

		$html = strip_tags($set_news->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 20);
			
?>
<div class="post hover-light">
<div class="meta inline-meta small-meta">
<div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>"></div>
<span class="author"><?=$set_news->name?></span>
<br>
<span class="date"><?=date("d M 'y",$set_news->created)?></span>
</div>
<div class="border-bottom2 mb2 color-1"></div>
<p><a href="news/v/<?=$set_news->id?>" ><?=$new_html?></a></p>
</div>
<?php
		}
	}
}
?>
    </div>
    <!-- /.col -->
    
    <div class="col-md-6">
<?php
$newsArr= array();
$home_editorial_newsTitle = '';
if(isset($home_featured_2[6])){
	$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured_2[6]->author_id),false,true);
	if($user_data){
		$html = strip_tags($home_featured_2[6]->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$newsArr['text'] = word_limiter($html, 100);
		$newsArr['user_data'] = $user_data;
		$newsArr['data'] = $home_featured_2[6];
	}
}
if($newsArr){
?>
        <div class="post first hover-dark">
            <a href="news/v/<?=$newsArr['data']->id?>">
                <div class="image" data-src="<?=!empty($newsArr['data']->image)?'assets/uploads/news/full/'.$newsArr['data']->image:'assets/uploads/no-image.gif'?>">
                    <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                </div>
            </a>
        </div>
<?php
}
?>
        <div class="row">
<?php
if($newsArr){
?>
        
            <div class="col-md-7">
                <div class="post hover-light">
                    <h4><a href="news/v/<?=$newsArr['data']->id?>"><?=$newsArr['data']->name?></a></h4>
                    <p><?=$newsArr['text']?></p>
                </div>            
            </div>
<?php
}
?>            
<?php
if(isset($home_featured_2[7])){
	$userName = '';
	$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured_2[7]->author_id),false,true);
	if($user_data){
		$userName = $user_data->name;
	}
?>
    <div class="col-md-5">

        <div class="post hover-light color-3">
<?php
if(!empty($home_featured_2[7]->label)){
?>
<div class="meta">
<a href="news/v/<?=$home_featured_2[7]->id?>" class="label bgred"><?=$home_featured_2[7]->label?></a>
</div>
<?php
}
?>                    
            <p><?=$home_featured_2[7]->name?></p>
            <div class="meta inline-meta small-meta">
                <span class="author"><?=$userName?></span>
                <span class="date"><?=date("d M 'y",$set_news->created)?></span>
            </div>
        </div>

<?php
if(isset($home_featured_2[8])){
$userName = '';
$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured_2[8]->author_id),false,true);
if($user_data){
$userName = $user_data->name;
}
?>

        <div class="post hover-light">
<?php
if(!empty($home_featured_2[8]->label)){
?>
<div class="meta">
<a href="news/v/<?=$home_featured_2[8]->id?>" class="label bgred"><?=$home_featured_2[8]->label?></a>
</div>
<?php
}
?>                    
            <p><?=$home_featured_2[8]->name?></p>
            <div class="meta inline-meta small-meta">
                <span class="author"><?=$userName?></span>
                <span class="date"><?=date("d M 'y",$set_news->created)?></span>
            </div>
        </div>
<?php
}
?>                
        
    </div>
<?php
}
?>            
        </div>

        <!-- /.row -->
        
    </div>
        <!-- /.col -->
        
    </div>
    <!-- /.row -->
</div>
<?php
}
if($home_featured_3){
?>
<div class="swiper-slide">
<div class="row">
    <div class="col-sm-6 col-md-3">
<?php
$n_i= 0;
foreach($home_featured_3 as $set_news){
	$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
	if($user_data){
		$n_i++;
		if($n_i>=4){
			break;
		}
		$html = strip_tags($set_news->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 20);
		
?>
<div class="post hover-light">
<div class="meta inline-meta small-meta">
<div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>"></div>
<span class="author"><?=$set_news->name?></span>
<br>
<span class="date"><?=date("d M 'y",$set_news->created)?></span>
</div>
<div class="border-bottom2 mb2 color-1"></div>
<p><a href="news/v/<?=$set_news->id?>" ><?=$new_html?></a></p>

</div>
<?php
	}
}
?>
                        </div>
                        <!-- /.col -->
    
    <div class="col-sm-6 col-md-3">

<?php
$n_i= 0;
$skip_i = 0;
foreach($home_featured_3 as $set_news){
	$skip_i++;
	if($skip_i>3){
		$user_data = $this->comman_model->get_by('authors',array('id'=>$set_news->author_id),false,true);
		if($user_data){
			$n_i++;
			if($n_i>=4){
				break;
			}
		$html = strip_tags($set_news->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$new_html = word_limiter($html, 20);
			
?>
<div class="post hover-light">
<div class="meta inline-meta small-meta">
<div class="image image-small" data-src="<?=!empty($user_data->image)?'assets/uploads/news/full/'.$user_data->image:'assets/uploads/profile.jpg'?>"></div>
<span class="author"><?=$set_news->name?></span>
<br>
<span class="date"><?=date("d M 'y",$set_news->created)?></span>
</div>
<div class="border-bottom2 mb2 color-1"></div>
<p><a href="news/v/<?=$set_news->id?>" ><?=$new_html?></a></p>
</div>
<?php
		}
	}
}
?>
    </div>
    <!-- /.col -->
    
    <div class="col-md-6">
<?php
$newsArr= array();
$home_editorial_newsTitle = '';
if(isset($home_featured_3[6])){
	$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured_3[6]->author_id),false,true);
	if($user_data){
		$html = strip_tags($home_featured_3[6]->description);
		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');    
		$newsArr['text'] = word_limiter($html, 100);
		$newsArr['user_data'] = $user_data;
		$newsArr['data'] = $home_featured_3[6];
	}
}
if($newsArr){
?>
        <div class="post first hover-dark">
            <a href="news/v/<?=$newsArr['data']->id?>">
                <div class="image" data-src="<?=!empty($newsArr['data']->image)?'assets/uploads/news/full/'.$newsArr['data']->image:'assets/uploads/no-image.gif'?>">
                    <img src="assets/frontends/images/5x3.png" alt="Proportion"/>
                </div>
            </a>
        </div>
<?php
}
?>
        <div class="row">
<?php
if($newsArr){
?>
        
            <div class="col-md-7">
                <div class="post hover-light">
                    <h4><a href="news/v/<?=$newsArr['data']->id?>"><?=$newsArr['data']->name?></a></h4>
                    <p><?=$newsArr['text']?></p>
                </div>            
            </div>
<?php
}
?>            
<?php
if(isset($home_featured_3[7])){
	$userName = '';
	$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured_3[7]->author_id),false,true);
	if($user_data){
		$userName = $user_data->name;
	}
?>
    <div class="col-md-5">

        <div class="post hover-light color-3">
<?php
if(!empty($home_featured_3[7]->label)){
?>
<div class="meta">
<a href="news/v/<?=$home_featured_3[7]->id?>" class="label bgred"><?=$home_featured_3[7]->label?></a>
</div>
<?php
}
?>                    
            <p><?=$home_featured_3[7]->name?></p>
            <div class="meta inline-meta small-meta">
                <span class="author"><?=$userName?></span>
                <span class="date"><?=date("d M 'y",$set_news->created)?></span>
            </div>
        </div>

<?php
if(isset($home_featured_3[8])){
$userName = '';
$user_data = $this->comman_model->get_by('authors',array('id'=>$home_featured_3[8]->author_id),false,true);
if($user_data){
$userName = $user_data->name;
}
?>

        <div class="post hover-light">
<?php
if(!empty($home_featured_3[8]->label)){
?>
<div class="meta">
<a href="news/v/<?=$home_featured_3[8]->id?>" class="label bgred"><?=$home_featured_3[8]->label?></a>
</div>
<?php
}
?>                    
            <p><?=$home_featured_3[8]->name?></p>
            <div class="meta inline-meta small-meta">
                <span class="author"><?=$userName?></span>
                <span class="date"><?=date("d M 'y",$set_news->created)?></span>
            </div>
        </div>
<?php
}
?>                
        
    </div>
<?php
}
?>            
        </div>

        <!-- /.row -->
        
    </div>
        <!-- /.col -->
        
    </div>
    <!-- /.row -->
</div>    					    		
<?php
}
?>

			
					
				</div>
				<!-- /.swiper-wrapper -->

				<div class="pagination-next-prev bordered mt3">
					<a href="#" class="swiper-button-prev arrow-link" title="Prev"><img src="assets/frontends/images/arrow-left.png" alt="Arrow"></a>
					<a href="#" class="swiper-button-next arrow-link" title="Next"><img src="assets/frontends/images/arrow-right.png" alt="Arrow"></a>
				</div>

			</div>
			<!-- /.swiper-container -->

		</div>
<?php
}
?>        
