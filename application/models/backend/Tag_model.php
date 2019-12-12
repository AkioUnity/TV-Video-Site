<?php

class Tag_model extends MY_Model {
	
	protected $_table_name = 'news_tag';
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
        $memberships->parent_id	 			= 0;
        
        return $memberships;
	}

	public function save_order ($data)
	{
		if (count($data)) {
			foreach ($data as $order => $categories) {
				if ($categories['item_id'] != '') {
					$data = array('parent_id' => (int) $categories['parent_id'], 'order' => $order);
					$this->db->set($data)->where($this->_primary_key, $categories['item_id'])->update($this->_table_name);
				}
			}
		}
	}


	public function get_nested($limit=false)
	{
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->order_by($this->_order_by);
		$categories = $this->db->get()->result_array();
		
		$array = array();
		foreach ($categories as $n) {         
			if (! $n['parent_id']) {
				// This page has no parent
				$array[$n['id']] = $n;
			}
			else {
				// This is a child page
				$array[$n['parent_id']]['children'][] = $n;
			}
		}
		return $array;
	}


    public function get_no_parents($lang_id=1)
	{
        // Fetch pages without parents
        $this->db->select('*');
        $this->db->where('parent_id', 0);
        $categories = parent::get();
        
        // Return key => value pair array
        $array = array(0 => 'Select');
        //$array = array(0 => lang('No parent'));
        if(count($categories))
        {
            foreach($categories as $n)
            {
                $array[$n->id] = $n->name;
            }
        }
        
        return $array;
	}


    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


