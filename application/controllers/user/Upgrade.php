<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

class Upgrade extends Frontend_Controller{	
	public $_redirect = 'user/upgrade';

	public $_subView = 'user/upgrade/';
	public $_table_names = 'channels';
	public $_mainView = 'user/_new_layout';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->load->library(array('paypal'));
		$this->data['active'] = 'channel';
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$this->data['_user_link'] = 'user';
        $this->data['_cancel'] = $this->_redirect;
        $this->perPage = 20;
		$this->data['userPermission'] = array();
		if(!empty($this->data['user_details']->permissions)){
			$this->data['userPermission'] = explode(',',$this->data['user_details']->permissions);
		}
	}

	function index(){
		redirect($this->data['_cancel'].'/form');
        $this->data['name'] = 'Channel';
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function ajax_list(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;
		$where_clause = '';
		$url  = $this->data['_cancel'].'/ajax_list?';
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$where_clause = '';

		$g_s_date = $this->input->get('s_date');
		if($g_s_date){
			$where_clause .= 'date(on_date) >= (\''.$g_s_date.'\') and';
			$url .= 's_date='.$g_s_date.'&';
		}

        $g_e_date = $this->input->get('e_date');
		if($g_e_date){
			$where_clause .= ' date(on_date)  <= (\''.$g_e_date.'\') and';
			$url .= 'e_date='.$g_e_date.'&';
		}	

		$name = $this->input->get('q');
		if($name){
			$url .= 'q='.$name.'&';
			$where_clause .= " (lower(name) like '%".strtolower($name)."%' or lower(id) like '%".strtolower($name)."%'  ) and";
		}


		$sort = ' id desc';
		$output['result']= 'ok';

		$stringQuery = "SELECT *  FROM channels where user_id =".$this->data['user_details']->id;	
		$where_clause = rtrim($where_clause,'and');
		if($where_clause){
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and ".$where_clause." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." and ".$where_clause." ORDER BY $sort");
		}
		else{
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." ORDER BY $sort");
		}
			
		//echo $this->db->last_query();die;

		$output['html'] = $this->load->view($this->_subView.'ajax_list',$this->data,true);
		if(empty($output['html'])){
			$output['html'] ='';
		}

		$output['url'] =$url;
		echo json_encode($output);
		//echo $msg;	
	}

	function form(){
		$rules = array(
        		'type' 					=> array('field'=>'type', 'label'=>'Name', 'rules'=>'trim'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->session->unset_userdata('user_form');

			$post1 =array('type','membership');
        	$post_data = $this->comman_model->array_from_post($post1);
			//printR($post_data);die;
			$total = 0;
			$stringName = '';
			if($post_data['membership']=='coicio'){
				$post_data['coicio_payment'] = 1;
				$stringName .= 'COICIOPRO ';
				$total = 99;
			}
			else{
				$post_data['coicio_payment'] = 0;
			}
			if($post_data['membership']=='concierge'){
				$post_data['concierge_payment'] = 1;
				if(!empty($stringName)){
					$stringName .= '+ Concierge';
				}
				else{
					$stringName .= 'Concierge';
				}
				$total = 499;
			}
			else{
				$post_data['concierge_payment'] = 0;
			}
			//echo '<br>'.$total;
			if($post_data['type']=='annual'){
				$stringName .= ' (Annual)';
				$total = $total*12;
				$total = round($total-($total*20/100),2);
			}
			else{
				$stringName .= ' (Month)';
			}
			
			//echo '<br>'.$total;die;
			$post_data['name'] = $stringName;
			$post_data['amount'] = $total;
			$this->session->set_userdata('user_form',$post_data);	
			redirect($this->data['_cancel'].'/card_form');
        }
		
		$this->data['name'] = 'Payment';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['subview'] = $this->_subView.'payment_form';
        $this->load->view($this->_mainView, $this->data);		
	}
	
	function card_form(){
		$post_session = $this->session->userdata('user_form');
		if(isset($post_session)){
		}
		else{
			redirect($this->data['_cancel'].'/form');
		}

		$rules = array(
        		'type' 					=> array('field'=>'type', 'label'=>'Name', 'rules'=>'trim'),
			   );

    
	    $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$paypalSettings = $this->comman_model->get_by('paypal_setting',array('id'=>1),false,true);
		
			if(!$paypalSettings){
				redirect($this->data['_cancel'].'/form');
			}
				
			$currency = "USD";
			$live= 'live';
			if($paypalSettings->sandbox==1){
				$live = 'test';
			}
			$this->paypal->setup($paypalSettings->username, $paypalSettings->password,$paypalSettings->signature,$live);
			$post_data = $this->comman_model->array_from_post(array('card_number','card_month','card_year','card_cvv'));
			$total =$post_session['amount'];
			$request = array(
					'PAYMENTACTION' => 'Sale',
					'IPADDRESS'			=> $_SERVER['REMOTE_ADDR']		
				);
			
				$card = array(
					'CREDITCARDTYPE'		=> 'Visa',
					'ACCT'					=> $post_data['card_number'],
					'EXPDATE'				=> $post_data['card_month'].$post_data['card_year'],
					'CVV2'					=> $post_data['card_cvv']
				);
			
				$address = array(
					'STREET'			=> $this->data['user_details']->address,
					'CITY'				=> '',
					'STATE'				=> '',
					'ZIP'				=> ''
				);
			
				$details = array(
					'AMT'			=> $total,
					'CURRENCYCODE'	=> 'USD'
				);
			
			$results = $this->paypal->do_direct_payment($request, $card, $address, $details);		
//			printR($results);die;
			if($results['ACK']=='Success'){
				$post_data							= $this->data['session_data']['user_form'];
/*				$post_data['coicio_payment']		= $this->data['session_data']['user_form']['coicio_payment'];
				$post_data['concierge_payment']		= $this->data['session_data']['user_form']['concierge_payment'];
				$post_data['type']					= $this->data['session_data']['user_form']['payment_type'];
				$post_data['amount']				= $this->data['session_data']['user_form']['amount'];
				$post_data['name']					= $this->data['session_data']['user_form']['name'];*/
		
				$post_data['token']					= $results['TRANSACTIONID'];
				$post_data['payment_type']			= 'paypal';
				$post_data['amt']					= $results['AMT'];
				$post_data['payment_data']			= serialize($results);
				$post_data['user_id']				= $this->data['user_details']->id;
				$post_data['is_payment']			= 1;
				$post_data['status']				= 1;
				$post_data['on_date']				= date('Y-m-d H:i');

				$this->db->trans_start();
				$history_id = $this->comman_model->save('users_payment_history',$post_data);
				$this->db->where(array('id'=>$this->data['user_details']->id));
				$u_data = array('plan_id'=>$history_id,'plan_date'=>date('Y-m-d'));
				if($post_data['type']=='month'){
					$u_data['plan_month'] = 1;
				}
				else{
					$u_data['plan_month'] = 12;
				}
				$this->db->update('users',$u_data);
				$this->db->trans_complete();
				$this->session->unset_userdata('user_form');
				redirect($this->data['_cancel'].'/success');
			}
			else{
				$this->session->unset_userdata('user_form');
				$this->session->set_flashdata('error',$results['L_LONGMESSAGE0']);
				redirect($this->data['_cancel'].'/form');
			}
			
			die;
        }
		
		$this->data['name'] = 'Payment';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['subview'] = $this->_subView.'card_form';
        $this->load->view($this->_mainView, $this->data);		
	}


	function success(){
        $this->data['name'] = 'Payment';
        $this->data['subview'] = $this->_subView.'success';
		$this->load->view($this->_mainView,$this->data);
	}
		
	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='U'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect('secure/login');
		}
	}


}
