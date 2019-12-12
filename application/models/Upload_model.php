<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload_model extends CI_Model {
function upload_files($files,$path,$file_name=false){
		$this->load->library('image_lib');
		$result = array('status'=>'error','message'=>'file not select');
		$field_name = $files;
		if($file_name){
			$new_name = $file_name;
			$config['file_name'] = $new_name;
		}
		$config['upload_path'] = $path.'/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '9000000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($field_name)){
			$result['message'] =$this->upload->display_errors();
			return $result; 
		}
		else{
			$upload_data 	= $this->upload->data();
			$result = array('status'=>'ok','data'=>$upload_data);
			$this->image_lib->clear();		
		}
		return $result;
	}	
	
	function simple_image_upload($files,$path,$file_name=false,$file_size=false){
		$result = array('status'=>'error','message'=>'file not select');
		$field_name = $files;
		if($file_name){
			$new_name = $file_name;
			$config['file_name'] = $new_name;
		}
		$config['upload_path'] = $path.'/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		if($file_size){
			$config['max_size']	= $file_size;
		}
		else{
			$config['max_size']	= '900000';
		}
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($field_name)){
			$result['message'] =$this->upload->display_errors();
			return $result; 
		}
		else{
			$upload_data 	= $this->upload->data();
			$result = array('status'=>'ok','data'=>$upload_data);
		}
		return $result;
	}
	
	function simple_upload($files,$path,$file_name=false){//upload with water marks
		$result = array('status'=>'error','message'=>'file not select');
		$field_name = $files;
		if($file_name){
			$new_name = $file_name;
			$config['file_name'] = $new_name;
		}
		$config['upload_path'] = $path.'/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['max_size']	= '900000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($field_name)){
			$result['message'] =$this->upload->display_errors();
			return $result; 
		}
		else{
			$upload_data 	= $this->upload->data();
			$this->load->library('image_lib');
			$config['image_library'] = 'GD2';
			$config['source_image'] = $path.'/'.$upload_data['file_name'];
			$config['wm_type'] = 'overlay';
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'right';
			$config['wm_overlay_path'] = './assets/uploads/watermark.png';//the overlay image
			$config['wm_opacity']=60;
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();

			$result = array('status'=>'ok','data'=>$upload_data);
		}
		return $result;
	}
 			
	function do_upload($files,$path,$file_name=false){
		$result = array('status'=>'error','message'=>'file not select');
		$field_name = $files;
		if($file_name){
			$new_name = $file_name;
			$config['file_name'] = $new_name;
		}
		
		$config['upload_path'] = $path.'/full/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['max_size']	= '900000';
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($field_name)){
			$result['message'] =$this->upload->display_errors();
			return $result; 
		}
		else{
			$upload_data = $this->upload->data();
			$this->load->library('image_lib');
/*			$config['image_library'] = 'GD2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['wm_text'] = 'tutsmore';
	 		$config['wm_type'] = 'text';
			$config['wm_opacity'] = 10;
			$config['new_image'] = $path.'/full/mark_'.$upload_data['file_name'];
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();*/


			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 450;
			$config['height'] = 450;

			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();		
			$result = array('status'=>'ok','data'=>$upload_data);
//			array_push($result,'success',$upload_data['file_name']);
			return $result;
		}
	}
			
    public function upload_file($tmpFile,$path){
		$output =array('status'=>0,'msge'=>'file path not exists');
		$target_dir = $path;
		//$target_file = $target_dir . basename($_FILES[$tmpFile]["name"]);
		//echo $target_file = $target_dir .time().'.'.$imageFileType;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($_FILES[$tmpFile]["name"],PATHINFO_EXTENSION));
		$fileName = time().'.'.$imageFileType;
		$target_file = $target_dir .$fileName;
		// Check if image file is a actual image or fake image
/*		if(isset($_POST["submit"])) {
			echo 'id';
			$check = getimagesize($_FILES[$tmpFile]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}*/
		// Check if file already exists
/*		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}*/
		// Check file size
/*		if ($_FILES[$tmpFile]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}*/
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$output['msge'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES[$tmpFile]["tmp_name"], $target_file)) {
				$output['status'] = 1;
				$output['name'] = $fileName;
				$output['msge'] = '';
/*				echo "The file ". basename( $_FILES[$tmpFile]["name"]). " has been uploaded.";
*/
			} else {
				$output['msge'] = "Sorry, there was an error uploading your file.";
			}
		}
		return $output;
	}
    
}



