<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Permalink
 *
 * Authentication library for Code Igniter.
 *
 * @package		Permalink
 * @author		Shadel
 * @version		1.0.0
 */
class Master_page
{

	function __construct()
	{
		$this->ci =& get_instance();

	}

	function view($data)
	{
		$this->ci->load->model('categories');
		$categories = $this->ci->categories->get_categories();
		$mergeData = array(
				'category' => 'category',
				'categoryData' => $categories,
				'home' => 'http://tuyetbut.com',
				'exceptImg' => 'http://truyen.hixx.info/assets/truyen/images/no_image_found_120x180.jpg',
				'sidebar' => 'sidebar',
				'sidebarData' => '');
		$this->ci->load->view('master_page',array_merge($mergeData, $data));
    #---------------------------------o
	}
}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */