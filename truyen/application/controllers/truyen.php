<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Truyen extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('url');
		$this->load->library('master_page');
		$this->load->library('data_api');
	}

	function index($story_permalink)
	{

		$this->ci->load->model('stories');
		$data = $this->ci->stories->get_story_by_permalink();
		
		$this->load->view('story', array('story'=>$data));
	}
	
	function home($limit)
	{
		$contentData = null;
		$this->ci->load->model('save');
		
		$contentData = $this->get_data('home', $key, null, $limit);
		
		$this->master_page->view(array(
				'content' => 'welcome',
				'contentData' => $contentData));
	}
	
	function category($category, $limit = 0) {
		$contentData = null;
		$this->ci->load->model('save');
		
		$key = $category."_".$limit;
		
		$contentData = $this->get_data('category', $key, $category, $limit);
		
		$this->master_page->view(array(
				'content' => 'categories',
				'contentData' => $contentData));
	}
	
	function chapter($chapterId) {
		$contentData = null;
		$this->ci->load->model('save');
	
		$key = $chapterId;
	
		$contentData = $this->get_data('chapter', $key, $chapterId);	
		$this->master_page->view(array(
				'content' => 'chapter',
				'contentData' => $contentData));
	}
	
	function story($storyId, $limit = 0) {
		
		if($limit > 0){
			$open_cl = true;
		} else {
			$open_cl = false;
		}
		
		$key = $storyId.'_'.$limit;
		$contentData = $this->get_data('story', $key, $storyId, $limit);
		$this->master_page->view(array(
				'open_cl' => $open_cl,
				'content' => 'story',
				'contentData' => $contentData));
	}
	
	function get_data($type, $key, $id, $limit = 0){
		$contentData = null;
		$this->ci->load->model('save');
		
		
		$data = $this->ci->save->get_save($type, $key);
		
		if ($data != null && $data->value != null) {
			$contentData = json_decode($data->value, true);
		} else {
			
			switch ($type) {
				case 'home': $contentData = $this->data_api->get_home($limit); break;
				case 'category' : $contentData = $this->data_api->get_category($id, $limit); break;
				case 'story' : $contentData = $this->data_api->get_story($id, $limit); break;
				case 'chapter' : $contentData = $this->data_api->get_chapter($id); break;
			}
			
			$this->ci->save->save(array(
					'type' => $type,
					'key' => $key,
					'value' => json_encode($contentData)
			));
		}
		return $contentData;
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */