<?php
class Slider_model extends MY_Model {
    
    protected $_table_name = 'sliders';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'name' => array('field'=>'name', 'label'=>'Title', 'rules'=>'trim|required|max_length[100]|xss_clean'),
   );
   
   public $rules_lang = array();
   
    public function __construct(){
        parent::__construct();
    }

    public function get_new()
    {
        $page = new stdClass();
        $page->parent_id = 0;
        $page->name = '';
        $page->link = '';
        $page->user_name = '';
        $page->article_link = '';
        $page->watch_link = '';
        $page->video_file = '';
        $page->description ='';
        return $page;
    }
    
    public function save_order ($pages)
    {
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] != '') {
                    $data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
                }
            }
        }
    }
    
    public function get_nested ($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get()->result_array();
        
        $array = array();
        foreach ($pages as $page) {         
            if (! $page['parent_id']) {
                // This page has no parent
                $array[$page['id']] = $page;
            }
            else {
                // This is a child page
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        return $array;
    }

    public function delete($id){
        $page_data = $this->get($id, TRUE);
        parent::delete($id);        		
       // $this->db->set(array('parent_id' => 0))->where('parent_id', $id)->update($this->_table_name);
    }

}

