<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_channel extends Frontend_Controller {
	public $_table_name = 'channels';
	public function __construct(){
		parent::__construct();
	}

	
	public function ajax_c_p($id=false){
		$outpput = array('status'=>'ok');
		$dateNow = date('Y-m-d H:i'); 
//		$string = "SELECT id,s_date,e_date,is_publish FROM shows WHERE '".$dateNow."' BETWEEN s_date AND e_date";
		$string = "SELECT id,s_date,e_date,is_publish FROM shows WHERE '".$dateNow."' NOT BETWEEN s_date AND e_date and is_publish=1";
		$all_date  = $this->comman_model->get_query($string,false);
		if($all_date){
			$outpput = array('status'=>'success');
			foreach($all_date as $set_date){
				$this->db->where('id',$set_date->id);
				$this->db->set('is_publish',0);
				$this->db->update('shows');
			}
		}
		$string = "SELECT id,s_date,e_date,is_publish FROM shows WHERE '".$dateNow."' BETWEEN s_date AND e_date and is_publish=0";
		$all_date  = $this->comman_model->get_query($string,false);
		if($all_date){
			$outpput = array('status'=>'success');
			foreach($all_date as $set_date){
				$this->db->where('id',$set_date->id);
				$this->db->set('is_publish',1);
				$this->db->update('shows');
			}
		}
		echo json_encode($outpput);
	}



}

