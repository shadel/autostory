<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Stories
 *
 * This model represents story data. It operates the following tables:
 * - story data,
 * - story translations
 *
 * @author Shadel
 */
class Crawl_data extends CI_Model
{
	private $table_story			= 'crawl_story';			// stories
	private $table_chapter			= 'crawl_chapter';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->load->library('permalink');
	}

	
	/**
	 * Get storiy records
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_stories()
	{
	
		$query = $this->db->get($this->table_story);
		if ($query->num_rows()) return $query->result();
		return NULL;
	}
	
	/**
	 * Get story record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_story_by_id($story_id)
	{
		$this->db->where('id', $story_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get story record by storyname
	 *
	 * @param	string
	 * @return	object
	 */
	function get_story_by_storyname($storyname)
	{
		$this->db->where('LOWER(storyname)=', strtolower($storyname));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get story record by storyname
	 *
	 * @param	string
	 * @return	object
	 */
	function get_story_by_url($url)
	{
		$this->db->where('LOWER(url)=', strtolower($url));
	
		$query = $this->db->get($this->table_story);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	/**
	 * Get story record by storyname
	 *
	 * @param	string
	 * @return	object
	 */
	function get_chapter_by_url($url)
	{
		$this->db->where('LOWER(url)=', strtolower($url));
	
		$query = $this->db->get($this->table_chapter);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	/**
	 * Create new story record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function save_story($data)
	{
		$re = array();
		$crawled = '';
		foreach ($data as $story){
			if(is_array($story)){
				$url = $story['url'];
				if(isset($story['crawled'])){
					$crawled = $story['crawled'];
				}
			} else {
				$url = $story->url;
				$crawled = $story->crawled;
			}
			
			$sql = $this->db->insert_string($this->table_story, $story) . ' ON DUPLICATE KEY UPDATE crawled="'.$crawled.'"';
			$this->db->query($sql);
			$story_id = $this->db->insert_id();
			array_push($re, $story_id);
				
		}
		return $re;
	}
	
	/**
	 * Create new story record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function save_chapter($data)
	{
		$re = array();
		$crawled = '';
		foreach ($data as $story){
			if(is_array($story)){
				$url = $story['url'];
				if(isset($story['crawled'])){
					$crawled = $story['crawled'];
				}
			} else {
				$url = $story->url;
				$crawled = $story->crawled;
			}
			
			
			
			$sql = $this->db->insert_string($this->table_chapter, $story) . ' ON DUPLICATE KEY UPDATE crawled="'.$crawled.'"';
			$this->db->query($sql);
			$story_id = $this->db->insert_id();
			array_push($re, $story_id);
	
		}
		return $re;
	}

	/**
	 * Delete story record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_story($story_id)
	{
		$this->db->where('id', $story_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_translations($story_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Update story login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function update_story($story_id, $data)
	{
		$this->db->where('id', $story_id);
		$this->db->update($this->table_name, $data);
	}

}

/* End of file storys.php */
/* Location: ./application/models/stories.php */