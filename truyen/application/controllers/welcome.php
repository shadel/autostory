<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('master_page');
		$this->load->library('data_api');
	}

	function index()
	{
		
		$contentData = null;
		$this->ci->load->model('save');
		
		$data = $this->ci->save->get_save('home');
		
		if ($data != null) {
			$contentData = json_decode($data->value, true);
		} else {
			$contentData = $this->data_api->get_home();
			$this->ci->save->save(array(
					'type' => 'home',
					'value' => json_encode($contentData)
					));
		}
		
		$this->master_page->view(array(
				'content' => 'welcome',
				'contentData' => $contentData));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */