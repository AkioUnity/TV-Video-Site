<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//for default controller file
class Ajax_category extends Frontend_Controller {
	public function __construct(){
		parent::__construct();
	}


	function ajaxGetSubcategory(){	
		$msge = array();
		$msge['status']= 'ok';

		$id = $this->input->post('id');
		$option = '<option value="0">Select</option>';
		if($id){
			$this->db->order_by('name','asc');
			$result = $this->comman_model->get_by('news_category',array('parent_id'=>$id),false);
			if($result){
				foreach($result as $set_result){
					$option .='<option value="'.$set_result->id.'">'.$set_result->name.'</option>';
				}
			}
		}
		$msge['msge'] = $option;
		echo json_encode($msge);
	}

}
