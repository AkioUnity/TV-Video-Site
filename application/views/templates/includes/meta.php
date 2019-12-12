<title><?php echo $title;?></title>       

<meta name="OWNER" content="<?=$settings['site_name'];?>" />

<meta name="AUTHOR" content="<?=$settings['site_name'];?>" />

<meta property="og:site_name" content="<?=$settings['site_name'];?>" >

<meta property="og:type" content="website" >
<meta property="og:url" content="<?=site_url(uri_string())?>" data-dynamic="true" />
<meta property="fb:app_id" content="<?=$settings['fb_app'];?>" >

<meta property="og:title" content="<?php echo $seo_title;?>" data-dynamic="true" />

<meta name="description" content="<?php echo $seo_description; ?>" data-dynamic="true">    

<meta name="keywords" content="<?php echo $seo_keywords; ?>" data-dynamic="true" />



<?php
if(isset($set_meta_image)&&!empty($set_meta_image)){
?>
<meta property="og:url" content="<?php echo $seo_url_link?>"  data-dynamic="true">
<meta property="og:description"   content="<?php echo $seo_description; ?>" />
<meta property="og:image" content="<?php echo $seo_url_image?>"  data-dynamic="true">
<meta property="og:image:width" content="444"  data-dynamic="true">
<meta property="og:image:height" content="640"  data-dynamic="true">
<?php	
}
else{
?>
<meta property="og:description"   content="<?php echo $seo_description; ?>" />
<meta property="og:image" content="<?=site_url().'assets/uploads/sites/'.$settings['logo']?>"  data-dynamic="true">
<meta property="og:image:width" content="444"  data-dynamic="true">
<meta property="og:image:height" content="640"  data-dynamic="true">
<?php
}
?>



