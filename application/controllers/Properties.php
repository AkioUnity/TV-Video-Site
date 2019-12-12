<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Properties extends Frontend_Controller {
	public $_subView = 'templates/properties/';
	public function __construct(){
		parent::__construct();
	}

	
	public function ajax($id = false){
		$output = array('status'=>'ok');
		$output['html'] = '';
		$key = "1234";
		$url = "https://ww2.getcoicio.com/api/properties/get?token=".$key."&limit=25";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
		$response = curl_exec($ch);
		curl_close($ch);
		$results = json_decode($response);
		
		if($results->status=='ok'){
			if($results->data){
				$this->data['properties'] = $results->data;
				$output['html'] = $this->load->view($this->_subView.'ajax_property',$this->data,true);
				if(empty($output['html'])){
					$output['html'] ='';
				}
			}
		}
			
        echo json_encode($output);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */