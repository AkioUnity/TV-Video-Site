<?php
class News_model extends MY_Model {
	
	protected $_table_name = 'news';
	protected $_order_by = 'order, id';
	public $rules = array(
		'name' => array('field'=>'name', 'label'=>'name', 'rules'=>'trim|required'),
	);
	
	public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
	}
	
    public function get_new(){
        $memberships = new stdClass();
        $memberships->category_id	 			= 0;
        $memberships->sub_category_id	 		= 0;
        $memberships->name	 					= '';
        $memberships->head_title				= '';
        $memberships->link	 					= '';
        $memberships->video_file				= '';
        $memberships->v_link					= '';
        $memberships->description	 			= '';
        $memberships->sponsor					= '';
        $memberships->sponsor_link				= '';
        $memberships->section					= '';
        $memberships->section					= '';
        $memberships->section					= '';
		
        
        return $memberships;
	}
	

    public function get_nested ($news_type){
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where(array('section'=>$news_type));
		
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get()->result_array();
        
        $array = array();
        foreach ($pages as $page) {         
                // This page has no parent
                $array[$page['id']] = $page;
        }
        return $array;
    }

    public function save_order ($pages){
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] != '') {
                    $data = array('order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
                }
            }
        }
    }
   
    public function save_tag($tags,$news_id){
		$this->db->delete('news_tags',array('news_id'=>$news_id));
        if ($tags) {
			$tag_arr = explode(',',$tags);
			if($tag_arr){
				foreach ($tag_arr as $set_tag) {
					$p_data = array(
									'news_id'	=> $news_id,
									'slug'	=> url_title($set_tag, 'dash', true),
									'name'	=> trim($set_tag),
								);
					$this->db->insert('news_tags',$p_data);
				}
			}
        }
    }

	
    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }
}
