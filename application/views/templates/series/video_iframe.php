<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<base href="<?php echo base_url();?>">
<?php $this->load->view('templates/includes/meta'); ?>
<style>
video#backgroundvid { 
position: fixed; right: 0; bottom: 0;
min-width: 100%; min-height: 100%;
width: auto; height: auto; z-index: -100;
background: url(polina.jpg) no-repeat;
background-size: cover; 
}
</style>
</head>
<body>
<video id="backgroundvid" controls>
    <source id="mp4-<?=$video_data->id?>" src="assets/uploads/news/<?=$video_data->video_file?>" type="video/mp4"/>
</video>
</body>
</html>