<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Story extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('master_page');
	}

	function index($story_permalink)
	{
		
		$this->ci->load->model('stories');
		$data = $this->ci->stories->get_story_by_permalink();
		
		$this->load->view('story', array('story'=>$data));
	}
	
	function get($story_permalink){
		
		$this->get_page($story_permalink, 0);
	}
	
	function get_page($story_permalink, $page){
		
		if($page){
			$open_cl = true;
		} else {
			$open_cl = false;
			$page = 1;
		}
		
		$this->ci->load->model('stories');
		$story = $this->ci->stories->get_story_by_permalink($story_permalink);
		
		$this->ci->load->model('chapters');
		$chapters = $this->ci->chapters->get_chapters_by_story($story->id, $page - 1);
		$newest_chapters =  $this->ci->chapters->get_chapters_new_by_story($story->id);

		$this->master_page->view(array(
				'content' => 'story',
				'contentData' => array('story'=>$story,
						'open_cl' => $open_cl,
						'page' => $page,
						'totalPage' => $this->ci->chapters->get_paginator($story->id),
						'chapters'=>$chapters,
						'newest_chapters' => $newest_chapters)));
	}
	
	function get_chapter($story_permalink, $chapter_permalink){
		$this->ci->load->model('stories');
		$story = $this->ci->stories->get_story_by_permalink($story_permalink);
		
		$this->ci->load->model('chapters');
		$chapter = $this->ci->chapters->get_chapter_by_permalink($story->id, $chapter_permalink);
		

		$this->master_page->view(array(
				'content' => 'chapter',
				'contentData' => array('story'=>$story,
				'chapter'=>$chapter,
				'chapterNext' => $this->ci->chapters->get_chapter_next($chapter),
				'chapterPrev' => $this->ci->chapters->get_chapter_prev($chapter))));
		
	}
	
	function new_story(){
	 if($this->input->server('REQUEST_METHOD') == 'GET'){
		$this->load->view('master_page', array('data'=> array(
// 				'head' => 'ckeditor',
				'content' => 'new_story')));
		return;
	 } 
	 $this->ci->load->model('stories');
	 $re = $this->ci->stories->create_story(array(
	 		'storyname' => $this->input->post('name'),
	 		'description' => $this->input->post('description')));
		var_dump($re);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */