<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crawl extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('tank_auth');
	}

	function get()
	{
		$url = $this->input->post('url');
		
		$fields_string = "";
		//url-ify the data for the POST
		
		//open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
		echo $result;
	}
	
	function auto(){
		$this->ci->load->model('crawl_data');
		
		
		$this->load->view('auto', array('stories' => $this->ci->crawl_data->get_stories()));
	}
	
	
	function set_story(){
		$this->ci->load->model('crawl_data');
		$data = $this->input->post('data');
		var_dump($this->ci->crawl_data->save_story($data));
	}
	
	function create_story(){
		$this->ci->load->model('crawl_data');
		$data = $this->input->post('data');
		$url = $this->input->post('url');
		$desc = $this->input->post('desc');
		$author = $this->input->post('author');
		$status = $this->input->post('status');
		
		$story = $this->ci->crawl_data->get_story_by_url($url);
		
		
		$this->ci->load->model('stories');
		if($story){
			$re = $this->ci->stories->create_story(array(
					'storyname' => $story->story,
					'categoryname' => $story->category,
					'description' => $desc));
		}
		$story = $this->ci->crawl_data->get_story_by_url($data[0]['storyUrl']);
		$story = $this->ci->stories->get_story_by_storyname($story->story);
		
		$this->ci->load->model('story_info');
		$this->ci->story_info->create_story_info(array(
				'image' =>  $this->input->post('img'),
				'story' => $story->id
				));
		
		if(isset($author)){
			$this->ci->load->model('story_author');
			$this->ci->story_author->create_story_author(array(
					'name' =>  $author,
					'story' => $story->id
			));
		}
		
		if(isset($status)){
			$this->ci->load->model('story_status');
			$this->ci->story_status->create_story_status(array(
					'name' =>  $status,
					'story' => $story->id
			));
		}
		
		$this->ci->crawl_data->save_chapter($data);
		
		$story = $this->ci->crawl_data->get_story_by_url($data[0]['storyUrl']);
		var_dump($story);
		
		
		$story->crawled = $url;
		$this->ci->crawl_data->save_story(array($story));
	}
	
	function create_chapter(){
		$this->ci->load->model('crawl_data');
		$content = $this->input->post('content');
		$url = $this->input->post('url');
	
		$chapter = $this->ci->crawl_data->get_chapter_by_url($url);
		$story = $this->ci->crawl_data->get_story_by_url($chapter->storyUrl);
		
		$this->ci->load->model('stories');
		$story = $this->ci->stories->get_story_by_storyname($story->story);
	
		$this->ci->load->model('chapters');
		
		var_dump($this->ci->chapters->create_chapter(array(
			'story' => $story->id,
			'name'  => $chapter->name,
			'content' => $content,
			'no' => $this->input->post('no')
		)));
	
		$chapter->crawled++;
		$this->ci->crawl_data->save_chapter(array($chapter));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */