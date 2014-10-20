<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('tank_auth');
		$this->load->library('master_page');
	}

	function index()
	{
		
		$this->page(1);
	}
	
	function getParam($id){
		echo $id;
	}
	
	function page($page){
		$this->ci->load->model('stories');
		$data = $this->ci->stories->get_stories($page - 1);
		
		$totalPage = $this->ci->stories->get_paginator();
		if (!$this->tank_auth->is_logged_in()) {
			$content = array(
					'data' => $data,
					'totalPage' => $totalPage,
					'page' => $page);
		} else {
			$user['user_id']	= $this->tank_auth->get_user_id();
			$user['username']	= $this->tank_auth->get_username();
			$content =  array('data'=>$data, 'user'=>$user);
		}
		
		
		$this->master_page->view(array(
				'content' => 'welcome',
				'contentData' => $content));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */