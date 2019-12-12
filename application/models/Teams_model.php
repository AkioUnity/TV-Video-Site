<?php

class Teams_model extends MY_Model {
	
	protected $_table_name = 'teams';
	protected $_order_by = 'id';
	public $rules = array(
		'name' => array('field'=>'name', 'label'=>'name', 'rules'=>'trim|required'),
	);
	
	public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
	}
	
    public function get_new(){
        $memberships = new stdClass();
        $memberships->name	 			= '';
        
        return $memberships;
	}


    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


