<?php
class banner_model extends MY_Model {
    
    protected $_table_name = 'banners';			//set table name
    protected $_order_by = 'parent_id, order, id'; //set order by

    public $rules = array(
        'parent_id' => array('field'=>'parent_id', 'label'=>'lang:Parent', 'rules'=>'trim|intval'),
        'language_id' => array('field'=>'language_id', 'label'=>'lang:Language', 'rules'=>'trim|intval'),
        'template' => array('field'=>'template', 'label'=>'Template', 'rules'=>'trim|required|xss_clean'),
   );
   
   public $rules_lang = array();
   
    public function __construct(){
        parent::__construct();
		$this->load->model(array('language_model'));

		//fetch lang name and image
/*        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);*/
                                  
    }

	//set a new one
    public function get_new()
    {
        $page = new stdClass();
        $page->parent_id = 0;
        $page->link ='';
        $page->desc = '';
        $page->template = '';
        $page->name = '';
        
        return $page;
    }
    
	//save data order by and this function has set many model for that table
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
    
    //for type of banner that show on front
    public function get_templates()
    {
        

        $templates = array( 
						"Author Bottom"=>"Author Bottom",
						"Episode Bottom"=>"Episode Bottom",
						"Video Page Bottom"=>"Video Page Bottom",
						"home_right"=>"Home (Right)",
						"news right"=>"News (Right)",
						"category_right"=>"Category (Right)",
						"footer"=>"Footer (page)",
						"footer_channel"=>"Footer (channel)",
					);
        
        return $templates;
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

