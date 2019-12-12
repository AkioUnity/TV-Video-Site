<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Series extends Frontend_Controller {
	public $_table_name = 'series';
	public $_subView = 'templates/series/';
	public function __construct(){
		parent::__construct();
	}

	public function video_frame($id=false){
		if(!$id){
			die('No Video');
		}

		$this->data['video_data'] = $checSeriesEpisode = $this->data['episode_data'] = $this->comman_model->get_by($this->_table_name.'_episode',array('id'=>$id),false,true);

		//if change lang than check lang slug of page
		if(!$checSeriesEpisode){
			die('No Video');
		}
		$this->load->view($this->_subView.'video_iframe',$this->data);
	}
	public function videos(){
$string = "SELECT series_episode.*,packages.slug AS p_url FROM series_episode 
JOIN packages ON series_episode.package_id = packages.id
where is_featured_show =1 and series_episode.enabled =1 and is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."' order by series_episode.id desc limit 15";
		$this->data['related_news'] = $this->comman_model->get_query($string,false);

$string = "SELECT series_episode.*,packages.slug AS p_url FROM series_episode 
JOIN packages ON series_episode.package_id = packages.id
where is_featured_show =1 and series_episode.enabled =1 and is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."' order by series_episode.id desc limit 15";
		$this->data['featured_show_list'] = $this->comman_model->get_query($string,false);

$string = "SELECT series_episode.*,packages.slug AS p_url FROM series_episode 
JOIN packages ON series_episode.package_id = packages.id
where is_top_pick =1 and series_episode.enabled =1 and is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."' order by series_episode.id desc limit 15";
		$this->data['top_pick_list'] = $this->comman_model->get_query($string,false);

$string = "SELECT series_episode.*, packages.slug AS p_url FROM series_episode 
JOIN packages ON series_episode.package_id = packages.id
where series_episode.enabled =1 and is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."' order by id desc limit 15";
		$this->data['new_video_list'] = $this->comman_model->get_query($string,false);

$string ="SELECT series_episode.*, COUNT(episode_id) AS show_count,packages.slug AS p_url FROM series_episode
JOIN packages ON series_episode.package_id = packages.id
JOIN series_view ON series_episode.id = series_view.episode_id
where is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."'
GROUP BY episode_id
ORDER BY show_count desc limit 20";
		$this->data['trending_list'] = $this->comman_model->get_query($string,false);

		$this->data['title'] = "Video | ".$this->data['settings']['site_name'];

		$this->load->view($this->_subView.'video_page_view',$this->data);
	}
	
	public function episode($id = false){
		if(!$id){
			redirect('front');
		}
		//fetch data
		$string = "SELECT series_episode.*,packages.slug AS p_url FROM series_episode 
JOIN packages ON series_episode.package_id = packages.id
where series_episode.id =".$id." and series_episode.enabled =1 and is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."' ";
//		$checSeriesEpisode = $this->comman_model->get_by($this->_table_name.'_episode',array('id'=>$id,'is_draft'=>0),false,true);
		$checSeriesEpisode = $this->comman_model->get_query($string,true);
		//if change lang than check lang slug of page
		if(!$checSeriesEpisode){
			redirect('front');
		}
		redirect('v/'.$checSeriesEpisode->p_url.'/series/'.$checSeriesEpisode->series_id.'/episode/'.$id);
	}
	
	public function package($package=false,$series=false,$series_id=false,$episode=false,$id = false){
		if(!$id){
			redirect('fvront');
		}

		//fetch data
		$checSeriesEpisode = $this->data['episode_data'] = $this->comman_model->get_by($this->_table_name.'_episode',array('id'=>$id,'is_draft'=>0),false,true);

		//if change lang than check lang slug of page
		if(!$this->data['episode_data']){
			redirect('front');
		}

		if($this->input->post('operation')){
			$pass = $this->input->post('pass');
			if($checSeriesEpisode->password!=$pass){
				$this->session->set_flashdata('error','Invalid Password!!'); 
				redirect('series/episode/'.$id);
			}

			$post_data = $_GET;
			$post_data['id'] = $id;
			$time_id = $post_data['times'] = time();
			
			$this->session->set_userdata('series_pass',array($post_data['id']=>$post_data));
			redirect('series/episode/'.$id);
			die;
		}

		$this->_view_count($checSeriesEpisode->id);
$string = "SELECT series_episode.*,packages.slug AS p_url FROM series_episode
JOIN packages ON series_episode.package_id = packages.id
where series_id=".$checSeriesEpisode->series_id." and package_id=".$checSeriesEpisode->package_id." and series_episode.id!=".$checSeriesEpisode->id."  and series_episode.enabled =1 and is_draft = 0 and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."' order by episode asc ";
		$this->data['episode_list'] = $this->comman_model->get_query($string,false);

		$this->data['related_news'] = array();
		if(!empty($checSeriesEpisode->tags)){
			$tagS = str_replace(',','|',$checSeriesEpisode->tags);
$string = 'SELECT series_episode.*,packages.slug AS p_url FROM series_episode
JOIN packages ON series_episode.package_id = packages.id
where CONCAT(",", `tags`, ",") REGEXP ",('.$tagS.'),"
 and series_episode.enabled =1 and is_draft = 0 '." and TIMESTAMP(s_date, s_time) <= '".date('Y-m-d H:i:s')."' AND TIMESTAMP(e_date, e_time) >= '".date('Y-m-d H:i:s')."'  order by id desc limit 15";
			$this->data['related_news'] = $this->comman_model->get_query($string,false);
		}
		$this->data['title'] = $this->data['episode_data']->name." | ".$this->data['settings']['site_name'];
		$this->data['seo_title'] = $this->data['episode_data']->name;

		if($checSeriesEpisode->is_password==1){
			if (isset($this->data['session_data']['series_pass'])&&array_key_exists($checSeriesEpisode->id,$this->data['session_data']['series_pass'])){
				$this->load->view($this->_subView.'episode_view',$this->data);
			}
			else{
				$this->data['title'] = "Special Access | ".$this->data['settings']['site_name'];
				$this->data['seo_title'] = 'Special Access';
				$this->load->view($this->_subView.'access',$this->data);
			}
		}
		else{
			$this->load->view($this->_subView.'episode_view',$this->data);
		}
	}
	
	
	public function _view_count($id=false){
		if($id){
			$ip_address = $this->input->ip_address();
			$check_ip = $this->comman_model->get_by('series_view',array('episode_id'=>$id,'ip_address'=>$ip_address),false,false,true);
			if(!$check_ip){
				$this->comman_model->save('series_view',array('episode_id'=>$id,'ip_address'=>$ip_address));
			}
		}
		return true;
	}	
}

