<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class comman_model extends CI_Model {
	protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
	protected $_timestamps = TRUE;
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    public function get_max_order($table){
        // get max order
        $this->db->select('MAX(`order`) as `order`', FALSE);
        $row = $this->db->get($table)->row();        
        return (int) $row->order;
    }
	//fetch data with no lang data
    public function get_no_lang($table_name,$where=false,$parent_id,$single = FALSE){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->join($table_name.'_lang', $table_name.'.id = '.$table_name.'_lang.'.$parent_id);
if($where){
	        $this->db->where($where);
}
        
        if($single == TRUE){
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
        return $query = $this->db->get()->$method();
	}
	//get fetch data with lang id and where clause
/*	-get_lang function for get video lang data by join table
1 parameter : table name
2 parameter : lang id
3 parameter : video id set default 'NULL'
4 parameter : where clause by array
5 parameter : for join field name like 'videos_id' field in videos_lang table
6 parameter : get single or multi data
*/
    public function get_lang($table_name,$lang_id=1,$id = NULL,$where=false,$parent_id,$single = FALSE){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->join($table_name.'_lang', $table_name.'.id = '.$table_name.'_lang.'.$parent_id);
        $this->db->where('language_id', $lang_id);
if($where){
	        $this->db->where($where);
}
        if($id != NULL){
	        $this->db->where($table_name.'.id', $id);
}
        
        if($single == TRUE){
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
/*        if(!count($this->db->order_by($this->_order_by))) {
$this->db->order_by($this->_order_by);
}
*/        
        return $query = $this->db->get()->$method();
/*        $result = $query->result();
        return $result;*/
	}
    public function get_no_parents($table_name,$where){
        // Fetch pages without parents
        $this->db->select('*');
        $this->db->where($where);
        $sizes = $this->db->get($table_name)->result();
        
        // Return key => value pair array
        $array = array();
        //$array = array(0 => lang('No parent'));
        if(count($sizes))
        {
            foreach($sizes as $n)
            {
                $array[$n->id] = $n->name;
            }
        }
        return $array;
	}
    
	//create or update data
/*
save function is insert or update data of any table
1 parameter : table name
2 parameter : save data with field=>value in array
3 parameter : update to id default id NULL is insert
*/
	public function save($table,$data, $id = NULL){    
// Set timestamps
if ($this->_timestamps == TRUE) {
$now = time();
$id || $data['created'] = $now;
$data['modified'] = $now;
}
// Insert
if ($id === NULL) {
!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
$this->db->set($data);
$this->db->insert($table);
$id = $this->db->insert_id();
}
// Update
else {
$filter = $this->_primary_filter;
$id = $filter($id);
$this->db->set($data);
$this->db->where($this->_primary_key, $id);
$this->db->update($table);
}
//echo $this->db->last_query();die;
	    return $id;
    }
	//create or update data with lang data
	public function save_with_lang($table,$data, $id = NULL){    
// Set timestamps
if ($this->_timestamps == TRUE) {
$now = time();
$id || $data['created'] = $now;
$data['modified'] = $now;
}
// Insert
if ($id === NULL) {
!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
$this->db->set($data);
$this->db->insert($table);
$id = $this->db->insert_id();
	        $curr_data_lang['product_id'] = $id;
            $language =  $this->get('language',false);
if($language){
foreach($language as  $set_value){
$curr_data_lang['language_id'] = $set_value->id;
$this->db->set($curr_data_lang);
$this->db->insert($table.'_lang');
}
}
}
// Update
else {
$filter = $this->_primary_filter;
$id = $filter($id);
$this->db->set($data);
$this->db->where($this->_primary_key, $id);
$this->db->update($table);
}
//echo $this->db->last_query();die;
	    return $id;
    }
/*
updat function 
1 parameter : table name
2 parameter : save data with field=>value in array
3 parameter : update to id 
*/
	public function update($table,$data, $id = NULL){    
// Set timestamps
$this->db->set($data);
$this->db->where($id);
$this->db->update($table);
//echo $this->db->last_query();die;
	   //return $id;
    }
    public function get_query_by_array($string,$single=false){
$query = $this->db->query($string);
      	if($single == TRUE) {
            $method = 'row_array';
        }
        else {
            $method = 'result_array';
        }
return $query->$method(); 
	}
    public function get_query($string,$single=false){
$query = $this->db->query($string);
      	if($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
//echo $this->db->last_query();die;
return $query->$method(); 
	}
//fetch data from any table 
/*
1 parameter : table name
2 parameter : where clause with array
3 parameter : where like clause
4 parameter : order by with array like array('id'=>'desc')
5 parameter : return single or multi data
*/
    public function get_by($table,$where= false,$order = false, $single = FALSE){
        
if($order){
foreach($order as $set =>$value){
	            $this->db->order_by($set,$value);
}
}
if($where){
	        $this->db->where($where);
}
       	//$this->get($table, $single);
       	//echo $this->db->last_query();die;
        return $this->get($table, $single);
    }
//fetch data from any table 
/*
1 parameter : table name
5 parameter : return single or multi data
*/
    public function get($table,$single = FALSE){
$this->_table_name = $table;
      	if($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
    
/*        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);
        }*/
//$this->db->get($this->_table_name)->$method();
       // echo $this->db->last_query();die;
        return $this->db->get($this->_table_name)->$method();
    }
//get post data 
	public function array_from_get($fields){
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->get($field);
        }
        return $data;
    }

	public function array_from_post($fields){
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }
   
	//upload image with path with 3 type of img store small full thumbnails
	function upload($file_name,$path){
$result = array();
$field_name = $file_name;
$config['upload_path'] = $path.'/';
$config['allowed_types'] = '*';
$config['max_size']	= '900000';
$this->load->library('upload', $config);
$this->upload->initialize($config); 
if (!$this->upload->do_upload($field_name)){
array_push($result,'error',$this->upload->display_errors());
return $result; 
}
else{
$upload_data = $this->upload->data();
$this->load->library('image_lib');
$config['image_library'] = 'gd2';
$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
$config['maintain_ratio'] = TRUE;
$config['width'] = 450;
$config['height'] = 450;
$this->image_lib->initialize($config);
$this->image_lib->resize();
$this->image_lib->clear();
$config['image_library'] = 'gd2';
$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
$config['maintain_ratio'] = TRUE;
$config['width'] = 100;
$config['height'] = 100;
$this->image_lib->initialize($config); 
$this->image_lib->resize();
$this->image_lib->clear();
array_push($result,'success',$upload_data['file_name']);
return $result;
}
	}
	//upload image with path with 3 type of img store small full thumbnails
	function do_upload($file_name,$path){
$result = array();
$field_name = $file_name;
$config['upload_path'] 
= $path.'/full/';
$config['allowed_types'] 	= 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
$config['remove_spaces']	= true;
$config['max_size']
= '*';
$this->load->library('upload', $config);
$this->upload->initialize($config); 
if (!$this->upload->do_upload($field_name)){
array_push($result,'error',$this->upload->display_errors());
return $result; 
}
else{
$upload_data = $this->upload->data();
$this->load->library('image_lib');
/*
$config['image_library'] = 'GD2';
$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
$config['wm_text'] = 'tutsmore';
	 
$config['wm_type'] = 'text';
$config['wm_opacity'] = 10;
$config['new_image'] = $path.'/full/mark_'.$upload_data['file_name'];
$this->image_lib->initialize($config);
$this->image_lib->watermark();*/
$config['image_library'] = 'gd2';
$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
$config['maintain_ratio'] = TRUE;
$config['width'] = 450;
$config['height'] = 450;
$this->image_lib->initialize($config);
$this->image_lib->resize();
$this->image_lib->clear();
$config['image_library'] = 'gd2';
$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
$config['maintain_ratio'] = TRUE;
$config['width'] = 100;
$config['height'] = 100;
$this->image_lib->initialize($config); 
$this->image_lib->resize();
$this->image_lib->clear();
array_push($result,'success',$upload_data['file_name']);
return $result;
}
	}
	//update input post img
	function upload_img($file_name,$path){
$result =array();
$result['status'] ='ok';
$field_name = $file_name;
list($type, $file_name) = explode(';', $file_name);
list(, $file_name)      = explode(',', $file_name);
$file_name = base64_decode($file_name);
$imageName = time().'.jpg';
file_put_contents($path.'/full/'.$imageName, $file_name);
$this->load->library('image_lib');
$config['image_library'] = 'gd2';
$config['source_image'] = $path.'/full/'.$imageName;
$config['new_image']	= $path.'/thumbnails/'.$imageName;
$config['maintain_ratio'] = TRUE;
$config['width'] = 450;
$config['height'] = 450;
$this->image_lib->initialize($config);
$this->image_lib->resize();
$this->image_lib->clear();
$config['image_library'] = 'gd2';
$config['source_image'] = $path.'/full/'.$imageName;
$config['new_image'] = $path.'/small/'.$imageName;
$config['maintain_ratio'] = TRUE;
$config['width'] = 100;
$config['height'] = 100;
$this->image_lib->initialize($config); 
$this->image_lib->resize();
$this->image_lib->clear();
$result['filename'] =$imageName;
return $result;
	}
	//insert data
	function add($table,$array){
$query = $this->db->insert($table,$array);
//echo $this->db->last_query();die;
//return $query->row_array();
return $this->db->insert_id();
	}
	//record_count data
	function record_count($table) {
        return $this->db->count_all($table);
    }
	//for query data
	function query_result($query){
$query = $this->db->query($query);
//echo $this->db->last_query();die;
return $query->result_array(); 
	}
	//for delete
    public function delete($table,$where){
$this->db->delete($table, $where);
    }
	function delete_by_id($table,$where)
	{
$this->db->delete($table, $where);
	}
	//for update by id
	function update_by_id($table_Name,$updatequery, $id){
$this->db->where('id', $id);
$this->db->update($table_Name, $updatequery);
	}
	//for update
	function update_by($table_Name,$updatequery,$condition){
$this->db->where($condition);
$this->db->update($table_Name, $updatequery);
//echo $this->db->last_query();die;
	}
	//for update
	function update_data_by_id($table_Name,$updatequery, $field_name,$value){
$this->db->where($field_name, $value);
$this->db->update($table_Name, $updatequery);
//echo $this->db->last_query();die;
	}
}
/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>