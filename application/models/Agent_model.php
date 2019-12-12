<?php

class Agent_model extends MY_Model {
	
	protected $_table_name = 'users';
	protected $_order_by = 'id';
	public $rules = array(
		'realtorName' => array('field'=>'realtorName', 'label'=>'name', 'rules'=>'trim|required'),
		'realtorEmail' => array('field'=>'realtorEmail', 'label'=>'email', 'rules'=>'trim|required'),
		'realtorCell' => array('field'=>'realtorName', 'label'=>'realtor cell', 'rules'=>'trim|required'),
		'realtyFixedPhone' => array('field'=>'realtyFixedPhone', 'label'=>'fixed phone', 'rules'=>'trim|required'),
		
		'realtyName' => array('field'=>'realtyName', 'label'=>'realty name', 'rules'=>'trim|required'),
		'realtyStreet1' => array('field'=>'realtyStreet1', 'label'=>'street 1', 'rules'=>'trim|required'),
		'realtyStreet2' => array('field'=>'realtyStreet2', 'label'=>'street2', 'rules'=>'trim|required'),
		'realtyState' => array('field'=>'realtyState', 'label'=>'state', 'rules'=>'trim|required'),
		'realtyCity' => array('field'=>'realtyCity', 'label'=>'city', 'rules'=>'trim|required'),
		'realtyZip' => array('field'=>'realtyZip', 'label'=>'city', 'rules'=>'trim|required'),
		'realtyCountry' => array('field'=>'realtyCountry', 'label'=>'city', 'rules'=>'trim|required'),
	);
	
   
	public function __construct(){
		parent::__construct();
	}
	
    public function get_new(){
        $new_form = new stdClass();
        $new_form->realtorName	 			= '';
        $new_form->realtorEmail	 			= '';
        $new_form->realtorCell	 			= '';
        $new_form->realtyName	 			= '';
        $new_form->realtyUrlLabel	 		= '';
        $new_form->realtyURL	 				= '';
        $new_form->realtyStreet1	 			= '';
        $new_form->realtyStreet2	 			= '';
        $new_form->realtyFixedPhone	 		= '';
        $new_form->realtyEmail	 			= '';
        $new_form->realtyCity	 			= '';
        $new_form->realtyState	 			= '';
        $new_form->realtyZip	 				= '';
        $new_form->realtyCountry	 			= '';
		

        
        return $new_form;
	}


    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


