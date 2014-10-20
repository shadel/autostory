<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Chapters
 *
 * This model represents story data. It operates the following tables:
 * - story data,
 * - story translations
 *
 * @author Shadel
 */
class Chapters extends CI_Model
{
	private $table_name			= 'chapter';			// stories
	private $limit_page = 50;
	private $limit_new = 10;
	
	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
	}

	
	/**
	 * Get storiy records
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_chapters_by_story($story_id, $page)
	{
		$this->db->where('story', $story_id);
		$this->db->limit($this->limit_page, $page*$this->limit_page);
		$this->db->order_by('no', 'asc');
		
		$query = $this->db->get($this->table_name);
		if ($query->num_rows()) return $query->result();
		return NULL;
	}
	
	function get_chapters_new_by_story($story_id)
	{
		$this->db->where('story', $story_id);
		$this->db->limit($this->limit_new, 0);
		$this->db->order_by('no', 'desc');
	
		$query = $this->db->get($this->table_name);
		if ($query->num_rows()) return $query->result();
		return NULL;
	}
	
	function get_paginator($story_id){
		
		$this->db->select('COUNT(*)');
		$this->db->where('story', $story_id);
		$query = $this->db->get($this->table_name);
	
		$row = $query->row_array();
		return ceil($row['COUNT(*)'] / $this->limit_page);
	}
	
	function get_chapter_next($chapter){
		$this->db->where('story', $chapter->story);
		$this->db->where('no >', $chapter->no);
		$this->db->order_by('no', 'asc');
		$this->db->limit(1, 0);
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	function get_chapter_prev($chapter){
		$this->db->where('story', $chapter->story);
		$this->db->where('no <', $chapter->no / 1);
		$this->db->order_by('no', 'desc');
		$this->db->limit(1, 0);
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() == 1) return $query->row();
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
	function get_chapter_by_permalink($story_id, $permalink)
	{
		$this->db->where('LOWER(permalink)=', strtolower($permalink));
		$this->db->where('story', $story_id);
		
		
		$query = $this->db->get($this->table_name);
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
	function create_chapter($data)
	{
		$re = array();
		$data['permalink'] = $this->permalink->permalink($data['name']);
		
		$sql = $this->db->insert_string($this->table_name, $data) . ' ON DUPLICATE KEY UPDATE content="'.mysql_real_escape_string($data['content']).'"';
		$this->db->query($sql);
		$story_id = $this->db->insert_id();
		
		if($story_id){
			$story = $data['story'];
			$storydata = array('id' => $story, 'updatetime' => date('Y-m-d H:i:s'));
			
			$this->ci->load->model('stories');
			$this->ci->stories->create_story($storydata);
			
		}
		
		return array('chapter_id' => $story_id);
		
		return NULL;
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