<?php
require_once('vendor/autoload.php');
require_once('application/libraries/S3.php');

class News_featured extends Admin_Controller
{
    public $_table_names = 'news';        //set table name
    public $_subView = 'admin/news/';    //set subview load
    public $_redirect = '/news_featured';            //set link with controller file name

    public function __construct()
    {
        parent::__construct();

        $this->checkPermissions('news_manage');
        //check for employee permission


        //set left menu active on admin dashboard
        $this->data['active'] = 'News Management';
        $this->load->model(array('news_model'));
        $this->data['tab_active'] = 'Featured Video';


        //set link with function name
        $this->data['_edit'] = $this->data['admin_link'] . $this->_redirect . '/edit';
        $this->data['_cancel'] = $this->data['admin_link'] . $this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'] . $this->_redirect . '/delete';
        $this->data['lang_id'] = $this->data['adminLangSession']['lang_id'];
        $this->data['section_type'] = array('Leader', 'Masonry Collage', 'Featured Video', 'Blazers', 'Property News', 'On The Beat', 'Finances', 'Editorial');

        $this->data['tab_section_type'] = array('Live', 'Featured', 'Archived', 'Featured Shows');
        $this->data['article_type'] = array('text', 'video', 'audio');
    }

    public function index()
    {
        //set title
        $this->data['name'] = 'News';
        $this->data['title'] = $this->data['name'] . ' | ' . $this->data['settings']['site_name'];

        //set load datatable.js
        $this->data['table'] = true;

        if ($this->data['admin_details']->default == 0) {
            //	$this->db->where('admin_id',$this->data['admin_details']->id);
        }

        // Fetch all data
        $this->db->order_by('id', 'desc');
        $this->data['all_data'] = $this->comman_model->get_by($this->_table_names, array('section' => 'Featured Video'), false);

        //set lead view
        $this->data['subview'] = $this->_subView . 'index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // Fetch a data or set a new one
        if ($id) {
            //set title
            $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'], 254);
            $this->data['title'] = $this->data['name'] . ' | ' . $this->data['settings']['site_name'];

            // Fetch a data
            $this->data['form_data'] = $this->comman_model->get_by($this->_table_names, array('id' => $id), FALSE, true);
            if (!$this->data['form_data'])
                redirect($this->data['_cancel']);
        } else {
            //set title
            $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'], 257);
            $this->data['title'] = $this->data['name'] . ' | ' . $this->data['settings']['site_name'];

            //set a new one
            $this->data['form_data'] = $this->news_model->get_new();
            $this->data['form_data']->author_id = '';
            $this->data['form_data']->label = '';

            $this->data['form_data']->tab_section = '';
            $this->data['form_data']->article_type = '';
            $this->data['form_data']->is_secure = '';
            $this->data['form_data']->page_password = '';
            $this->data['form_data']->tags = '';
            $this->data['form_data']->code = '';

            $this->data['form_data']->publish_date = date('Y-m-d');

            $this->data['form_data']->s_date = date('d-m-Y');
            $this->data['form_data']->e_date = h_addDate(date('d-m-Y'), 'day', 30, 'd-m-Y');


        }

        // Set validation rules for form
        $rules = $this->news_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $this->load->library('image_lib');
            $data = array();
            $postArr = array('name', 'tab_section', 'description', 'code', 'tab_section', 'link', 'article_type', 'video_file', 'v_link', 'label', 'author_id', 'tags');
            $data = $this->comman_model->array_from_post($postArr);

            /*			$data['tags'] = '';
                        if($this->input->post('tags')){
                            $data['tags']= implode(',',$this->input->post('tags'));
                        }*/

            $data['publish_date'] = h_dateFormat($this->input->post('publish_date'), 'Y-m-d');

            $data['s_date'] = h_dateFormat($this->input->post('s_date'), 'Y-m-d');
            $e_date = $this->input->post('e_date');
            if ($e_date) {
                $data['e_date'] = h_dateFormat($e_date, 'Y-m-d');
            }

            $is_secure = $this->input->post('is_secure');
            $data['is_secure'] = 0;
            $data['page_password'] = '';
            if ($is_secure == 1) {
                $data['page_password'] = $this->input->post('page_password');
                $data['is_secure'] = 1;
            }

            $data['section'] = 'Featured Video';
//			printR($_POST);
            if ($id == NULL) {
                $data['admin_id'] = $this->data['admin_details']->id;
                $data['n_rand_id'] = time() . random_string('numeric', 5);
                $data['on_date'] = date('Y-m-d');
                $data['created'] = time();
                $data['modified'] = time();
            } else {
                $data['modified'] = time();
            }
            ///	printR($data);
            if (!empty($_FILES['image']['name'])) {
                $result = $this->comman_model->do_upload('image', './assets/uploads/news');
                if ($result[0] == 'error') {
                    $this->session->set_flashdata('error', $result[1]);
                } else if ($result[0] == 'success') {
                    $data['image'] = $result[1];
                }
                $this->image_lib->clear();
            }

            if (!empty($_FILES['square_image']['name'])) {
                $result = $this->comman_model->do_upload('square_image', './assets/uploads/news');
                if ($result[0] == 'error') {
                    $this->session->set_flashdata('error', $result[1]);
                } else if ($result[0] == 'success') {
                    $data['square_image'] = $result[1];
                }
                $this->image_lib->clear();
            }


            if (!empty($_FILES['article_image']['name'])) {
                $result = $this->comman_model->do_upload('article_image', './assets/uploads/news');
                if ($result[0] == 'error') {
                    $this->session->set_flashdata('error', $result[1]);
                } else if ($result[0] == 'success') {
                    $data['article_image'] = $result[1];
                }
            }


            //$data['price'] = round($data['staff']+$data['coach']+$data['member'],2);
            $id = $this->comman_model->save($this->_table_names, $data, $id);
            $this->news_model->save_tag($data['tags'], $id);

            /*			$more_pic = $this->input->post('more_pic');
                        if($more_pic){
                            foreach($more_pic as $key=>$value){
                                $this->db->insert('properties_image', array('property_id'=>$id,'filename'=>$value));
                            }
                        }*/

            if (empty($this->data['form_data']->id))
                $this->session->set_flashdata('success', 'Data has successfully created.');
            else
                $this->session->set_flashdata('success', 'Data has successfully updated.');
            //	die;
            redirect($this->data['_cancel']);
        }

        $this->db->order_by('name', 'asc');
        $this->data['author_data'] = $this->comman_model->get_by('authors', array('enabled' => 1), false);

        /*	   	$this->db->order_by('name','asc');
                $this->data['news_tag_list'] = $this->comman_model->get_by('news_tag',array('enabled'=>1),false);*/

        $this->data['subview'] = $this->_subView . 'edit_featured';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function aws_upload()
    {
        $filesCount = count($_FILES['files']['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

            $dir = dirname($_FILES["file"]["tmp_name"]);
            $destination = $dir . DIRECTORY_SEPARATOR . $_FILES["file"]["name"];
            rename($_FILES["file"]["tmp_name"], $destination);

            $upload = $this->s3_upload->upload_file($destination);
        }
    }

    function delete_video()
    {
        $arr = array('status' => 'error', 'msge' => 'There is no video!!');
        $id = $this->input->post('id');
        $check_image = $this->comman_model->get_by($this->_table_names, array('id' => $id), false, true);
        if ($check_image) {
            $arr = array('status' => 'ok');
            $this->db->where('id', $id);
            $this->db->set('video_file', NULL, TRUE);
            $this->db->update($this->_table_names);
            $image = 'assets/uploads/news/' . $check_image->video_file;
            if (is_file($image))
                unlink($image);
        }
        echo json_encode($arr);
    }

    public function delete($id = false)
    {
        if (!$id)
            redirect($this->data['_cancel']);

        if ($this->data['admin_details']->default == '0') {
            $this->session->set_flashdata('error', 'Sorry ! You have no permission.');
            redirect($this->data['_cancel']);
        }

        $this->news_model->delete($id);
        redirect($this->data['_cancel']);
    }


    function checkPermissions($type = false, $is_redirect = false)
    {
        $redirect = 0;
        if ($this->data['admin_details']->default == '0') {
            $redirect = checkPermission('admin_permission', array('user_id' => $this->data['admin_details']->id, 'type' => $type, 'value' => 1));
        } else {
            $redirect = 1;
        }

        if ($redirect == 0) {
            $this->session->set_flashdata('error', 'Sorry ! You have no permission.');
            if ($redirect) {
                redirect($redirect);
            }
            redirect($this->data['admin_link'] . '');
        }
    }
}