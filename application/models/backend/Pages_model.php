<?php

class Pages_model extends MY_Model {

    

    protected $_table_name = 'page';

    protected $_order_by = 'parent_id, order, id';

    public $rules = array(

        'parent_id' => array('field'=>'parent_id', 'label'=>'lang:Parent', 'rules'=>'trim|intval'),

        'name' => array('field'=>'name', 'label'=>'name', 'rules'=>'trim|required'),

        'description' => array('field'=>'description', 'label'=>'description', 'rules'=>'trim'),

   );

   

   public $rules_lang = array();

   

    public function __construct(){

        parent::__construct();

		$this->load->model(array('language_model'));

    }



    public function get_new()

    {

        $page = new stdClass();

        $page->parent_id = 0;

        $page->bottom_menu = 0;

        $page->middle_menu = 0;		

        $page->top_menu = 0;

        $page->template = 'page';

        $page->name = '';

        $page->description = '';

		

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

    

    

    public function get_templates($template_prefix)

    {



        $templates = array(

							'page' 				=> 'Page',
							'presenters' 		=> 'Presenters page',
							'contact' 			=> 'Contact page',

							);

        

        return $templates;

    }

    

    public function get_lang($id = NULL, $single = FALSE, $lang_id=1)

    {

        if($id != NULL)

        {

            $result = $this->get($id);

            

            $this->db->select('*');

            $this->db->from($this->_table_name.'_lang');

            $this->db->where('page_id', $id);

            $lang_result = $this->db->get()->result_array();

            foreach ($lang_result as $row)

            {

                foreach ($row as $key=>$val)

                {

                    $result->{$key.'_'.$row['language_id']} = $val;

                }

            }

            

            foreach($this->languages as $key_lang=>$val_lang)

            {

                foreach($this->rules_lang as $r_key=>$r_val)

                {

                    if(!isset($result->{$r_key}))

                    {

                        $result->{$r_key} = '';

                    }

                }

            }

            

            return $result;

        }

        

        $this->db->select('*');

        $this->db->from($this->_table_name);

        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.page_id');

        $this->db->where('language_id', $lang_id);

        

        if($single == TRUE)

        {

            $method = 'row';

        }

        else

        {

            $method = 'result';

        }

        

        if(!count($this->db->order_by($this->_order_by))) {

			$this->db->order_by($this->_order_by);

		}

        

        $query = $this->db->get();

        $result = $query->result();

        return $result;

    }

    

    function delete_lang($page_id){

     $this->db->delete($this->_table_name.'_lang', array('page_id' => $page_id));



     echo $this->db->last_query();

    }



    public function save_with_lang($data, $data_lang, $id = NULL)

    {

        // Set timestamps

        if($this->_timestamps == TRUE)

        {

            $now = date('Y-m-d H:i:s');

            $id || $data['created'] = $now;

            $data['modified'] = $now;

        }



        // Insert

        if($id === NULL)

        {

            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;

            $this->db->set($data);

            $this->db->insert($this->_table_name);

            $id = $this->db->insert_id();

        }

        // Update

        else

        {



             // delete all lang data

            $this->db->delete($this->_table_name.'_lang', array('page_id' => $id));



           

            $filter = $this->_primary_filter;

            $id = $filter($id);

            $this->db->set($data);

            $this->db->where($this->_primary_key, $id);

            $this->db->update($this->_table_name);



           



        }

            // Save lang data

            foreach($this->languages as $lang_key=>$lang_val)

            {

                if(is_numeric($lang_key))

                {

                    $curr_data_lang = array();

                    $curr_data_lang['language_id'] = $lang_key;

                    $curr_data_lang['page_id'] = $id;

                    

                    foreach($data_lang as $data_key=>$data_val)

                    {

                        $pos = strrpos($data_key, "_");

                        if(substr($data_key,$pos+1) == $lang_key)

                        {

                            $curr_data_lang[substr($data_key,0,$pos)] = $data_val;

                        }

                    }

                    $this->db->set($curr_data_lang);

                    $this->db->insert($this->_table_name.'_lang');

                }

            }

        return $id;

    }

    

    public function get_no_parents($lang_id=1)

    {

        // Fetch pages without parents

        $this->db->select('*');

        $this->db->where('parent_id', 0);

        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.page_id');

        $this->db->where('language_id', $lang_id);

        $pages = parent::get();

        

        // Return key => value pair array

        $array = array(0 =>'No parent');

        if(count($pages))

        {

            foreach($pages as $page)

            {

                $array[$page->id] = $page->title;

            }

        }

        

        return $array;

    }

	

    public function get_nested ()

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

        $this->db->set(array('parent_id' => 0))->where('parent_id', $id)->update($this->_table_name);

    }



}



