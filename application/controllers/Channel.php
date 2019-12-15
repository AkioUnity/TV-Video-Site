<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends Frontend_Controller {
	public $_table_name = 'channels';
	public $_subView = 'templates/channels/';
	public function __construct(){
		parent::__construct();
        $this->data['_cancel'] = 'channel';
        $this->perPage = 20;
	}
	
	public function index($id = false,$type=false,$series=false,$episode=false){
		if(!$id){
			redirect('front');
		}
		$string = "select channels.*,users.username,users.image as u_image,users.social_media from channels join users on channels.user_id = users.id where enabled=1 and  channel_url='".$id."'";
		$this->data['channel_data'] = $check_data = $this->comman_model->get_query($string,true);
		if(!$check_data){
			redirect('front');
		}
		$this->visitors($check_data->id);

		$set_slider =true;
		$where_condition_1 = $where_condition = array('enabled'=>1,'status'=>1,'is_publish'=>1,'is_draft'=>0,'is_delete'=>0);
		$where_condition_1['channel_id'] = $check_data->id;
		$this->data['where_condition_1'] = $where_condition_1;
		if($type){
			if($type=='all'){
				$category = $this->input->get('category');
				if($category){
					$this->data['selected_category'] = $this->comman_model->get_by('shows_category',array('lower(shows_category.name)'=>str_replace('-',' ',strtolower($category))),false,true);
				}
			}
			else{
				$set_slider =false;
				if($episode&&$series){
					$seriesN = trim($series,'s');
					$episodeN = trim($episode,'ep');
					$check_video= $this->data['video_data'] = $this->comman_model->get_by('shows',array('channel_id'=>$check_data->id,'slug'=>$type,'series_number'=>$seriesN,'episode_number'=>$episodeN,'is_delete'=>0),false,true);
					if(!$check_video){
						redirect('channel/'.$id);
					}
				}
				else{
					redirect('channel/'.$id);
				}
				$string = "SELECT DISTINCT(category) as id,shows_category.name FROM shows_category
				INNER JOIN shows
				ON shows_category.id = shows.category where shows_category.user_id=".$check_data->user_id." order by shows_category.set_order asc limit 4";
				$this->data['category_list'] = $this->comman_model->get_query($string,false);
			}
		}
		else{
			$w_1 = $where_condition_1;
			$w_1['is_featured'] = 1;
			
			$this->db->limit(9);
			$this->db->order_by('set_order','asc');
			$this->db->order_by('id','desc');
			$this->data['featured_list'] = $this->comman_model->get_by('shows',$w_1,false,false);

			$w_2 = $where_condition_1;
			$w_2['is_complex'] = 1;
			$this->db->limit(9);
			$this->db->order_by('set_order','asc');
			$this->db->order_by('id','desc');
			$this->data['complex_list'] = $this->comman_model->get_by('shows',$w_2,false,false);
			$newc = $where_condition_1;
			$this->db->limit(12);
			$this->db->order_by('id','desc');
			$this->data['new_list'] = $this->comman_model->get_by('shows',$where_condition_1,false,false);
			
	$string = "SELECT DISTINCT(category) as id,shows_category.name FROM shows_category
INNER JOIN shows
ON shows_category.id = shows.category where shows_category.user_id=".$check_data->user_id." order by shows_category.set_order asc";
			$this->data['category_list'] = $this->comman_model->get_query($string,false);
		}
		
		if($set_slider){
			$w_1 = $where_condition_1;
			$w_1['is_slider'] =1;
			$this->db->limit(1);
			$this->db->order_by('id','desc');
			$this->db->select('id,video_file,video_link,image,name,short_description');
			$this->data['sliders'] = $this->comman_model->get_by('shows',$w_1,false,false);
		}
		
		if($type){
			if($type=='all'){
				$this->load->view($this->_subView.'all_video',$this->data);
			}
			else{
				$this->load->view($this->_subView.'view_video',$this->data);
			}
		}
		else{
			$this->load->view($this->_subView.'index',$this->data);
		}
			
	}

	function ajax_video(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			//exit('No direct script access allowed');
		}
		$output = array();
		$output['result']= 'error';
		$this->data['total'] = $output['total'] = 0;
		$where_clause = '';
		$url  = $this->data['_cancel'].'/ajax_video?';
        $page = $this->input->get('page');
        if(!$page){
			$this->data['page_number'] =1;
            $offset = 0;
        }else{
			$offset = $page*$this->perPage-$this->perPage;
			$this->data['page_number'] = $page;
        }


		$where_clause = '';
		$channel_id = $this->input->get('channel_id');
		if($channel_id){
			$url .= 'channel_id='.$channel_id.'&';
			$where_clause .= " channels.rand_id ='".$channel_id."' and";
		}

		$category = $this->input->get('category');
		if($category){
			$url .= 'category='.$category.'&';
			$where_clause .= " lower(shows_category.name) ='".str_replace('-',' ',strtolower($category))."' and";
		}

		$sort = ' shows.id desc';
		$output['result']= 'ok';

		$stringQuery = "SELECT shows.* FROM shows
join channels on shows.channel_id = channels.id 
join shows_category on shows.category = shows_category.id 
where shows.enabled= 1 and shows.is_delete=0 ";	
		$where_clause = rtrim($where_clause,'and');

		$this->data['total'] = 0;
		$this->data['all_data'] = array();
		if($where_clause){
			$this->data['all_data'] = $this->comman_model->get_query($stringQuery." and ".$where_clause." ORDER BY $sort limit $offset, ".$this->perPage,false);
			$this->data['total'] = $output['total'] = print_count_query($stringQuery." and ".$where_clause." ORDER BY $sort");
		}
		else{
		}

		$output['html'] = $this->load->view($this->_subView.'ajax_video',$this->data,true);
		$output['url'] =$url;
		echo json_encode($output);
		//echo $msg;	
	}
	
	function visitors($id=false){
		$ip_address = h_my_ip_address();
		if($id){
			$check = $this->comman_model->get_by('channels_click',array('channel_id'=>$id,'ip_address'=>$ip_address),false,false,true);
			if(!($check)){
				$this->db->insert('channels_click',array('on_date'=>date('Y-m-d H:i'),'ip_address'=>$ip_address,'channel_id'=>$id));
				$count = print_count('channels_click',array('channel_id'=>$id));
				$this->db->where('id',$id);
				$this->db->update('channels',array('view_count'=>$count));
			}
			else{
	/*			$this->db->where('id',$check->id);
				$this->db->update('products_click',array('on_date'=>date('Y-m-d H:i'),'counts'=>$check->counts+1));*/
			}
		}
	}
	
	function set_subscribe(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			//exit('No direct script access allowed');
		}
		$output = array();
		$output['status']= 'error';
		$output['message']= 'There is no channel';
		$id = $this->input->get('id');
		if(isset($this->data['user_details'])){
			if($id){
				$string = "select channels.id,users.username from channels join users on channels.user_id = users.id where enabled=1 and channels.rand_id='".$id."'";
				$check_data = $this->comman_model->get_query($string,true);
				if($check_data){
					$checkSubcribe = $this->comman_model->get_by('users_channels_subscribe',array('user_id'=>$this->data['user_details']->id,'channel_id'=>$check_data->id),false,false);
					if($checkSubcribe){
						$output['message']= 'You already subscribed this channel!!';
					}
					else{
						$this->db->trans_start();
						$post_data = array(
											'user_id' 		=> $this->data['user_details']->id,
											'channel_id' 	=> $check_data->id,
											'on_date'		=> date('Y-m-d H:i'),
										);
						$this->comman_model->save('users_channels_subscribe',$post_data);
					
						$this->db->trans_complete();
						$output['status']= 'ok';
						$output['message']= '';
					}
					
				}
			}
		}
		else{
				$output['message']= 'Please login first!';
		}
		echo json_encode($output);
		//echo $msg;	
	}


}

