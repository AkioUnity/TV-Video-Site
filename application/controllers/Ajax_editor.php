<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_editor extends Frontend_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	
	
	function ajax_upload(){
		$post_editor = $this->input->post('folder');
		if($post_editor){
			$dir = $post_editor;	
		}
		else{
			$dir = 'editors';	
		}
		if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $config['upload_path']      = 'assets/uploads/'.$dir.'/';
                $config['allowed_types']    = '*';
                $config['max_size']         = '60000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file'))
                {
                    if($_FILES['logo']['error'] != 4){
                        echo $this->upload->display_errors();
                    }
                }
                else
                {
                    $upload_data    = $this->upload->data();
					echo $upload_data['file_name'];
                }
            }
            else
            {
              echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
            }
        }
	}

}
