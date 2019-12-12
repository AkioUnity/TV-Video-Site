<?php

class Properties_model extends MY_Model {
	
	protected $_table_name = 'properties';
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
        $memberships->user_id	 			= 0;
        $memberships->address_display		= 0;
        $memberships->user_display			= 1;
        $memberships->name	 			= '';
        $memberships->description	 			= '';


        $memberships->sale_type	 			= '';
        $memberships->price_display	 			= '';
        $memberships->price_display	 			= '';
        $memberships->priceView	 			= '';
        $memberships->priceSearch	 			= '';
        $memberships->priceCurrency	 			= '';
        $memberships->bedroom	 			= 0;
        $memberships->bathroom	 			= 0;
        $memberships->carports	 			= 0;
        $memberships->airconditioning	 			= 0;
        $memberships->pool	 			= 0;
        $memberships->alarmSystem = 0;
        $memberships->other_features	 	= '';
        $memberships->carports	 			= 0;
        $memberships->carports	 			= 0;
        $memberships->unitNumber	 			= '';
        $memberships->streetNumber	 			= '';
        $memberships->street	 			= '';
        $memberships->address	 			= '';
        $memberships->city	 			= '';
        $memberships->state	 			= '';
        $memberships->postcode	 			= '';
        $memberships->country	 			= '';
        $memberships->landArea	 			= '';
        $memberships->landAreaUnit	 			= '';
        $memberships->landSize	 			= '';
        $memberships->landSizeUnit	 			= '';
        $memberships->floorArea	 			= '';
        $memberships->floorAreaUnit	 			= '';
        $memberships->buildingArea	 			= '';
        $memberships->buildingAreaUnit	 			= '';
        $memberships->propertyURL	 			= '';
        $memberships->propertyVideo	 			= '';
        $memberships->propertyTour	 			= '';
        $memberships->propertyLatitude	 			= '';
        $memberships->propertyLongitude	 			= '';
		
        $memberships->socialURL	 			= '';
        $memberships->dates	 			= date('Y-m-d');
        $memberships->availability	 			= '';
        
        return $memberships;
	}


    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


