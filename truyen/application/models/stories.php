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
class Stories extends CI_Model
{
	private $table_name			= 'stories';			// stories
	private $table_chapter			= 'chapter';
	private $translation_table_name	= 'story_translations';	// story translations
	private $limit_page = 50;

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
	function get_stories($page)
	{
		
		$sql = 'SELECT temp.*, b.cou as count FROM
					(SELECT st.*,ca.categoryname as categoryname, ca.permalink as capermalink, si.image as img
						FROM ('.$this->table_name.' as st LEFT JOIN  categories as ca ON  st.category = ca.id) LEFT JOIN story_info as si ON st.id = si.story) as temp,
					(SELECT count(*) as cou, story FROM chapter GROUP BY story) as b 
					WHERE b.story = temp.id ';
		$sql = $sql.' ORDER BY updatetime DESC';
		$sql = $sql.' LIMIT '.($page*$this->limit_page).','.$this->limit_page;
		
		
		
		$query = $this->db->query($sql);
		if ($query->num_rows()) return $query->result();
		return NULL;
	}
	
	
	
	function get_stories_by_category($categoryId, $page)
	{
	
	
		$sql = 'SELECT temp.*, b.cou as count FROM
					(SELECT st.*,ca.categoryname as categoryname, ca.permalink as capermalink, si.image as img
						FROM ('.$this->table_name.' as st LEFT JOIN  categories as ca ON  st.category = ca.id) LEFT JOIN story_info as si ON st.id = si.story 
						 WHERE ca.id="'.$categoryId.'") as temp,
					(SELECT count(*) as cou, story FROM chapter GROUP BY story) as b 
					WHERE b.story = temp.id ';
		$sql = $sql.' ORDER BY updatetime DESC';
		$sql = $sql.' LIMIT '.($page*$this->limit_page).','.$this->limit_page;
	
		$query = $this->db->query($sql);
		if ($query->num_rows()) return $query->result();
		return NULL;
	}
	
	function get_paginator(){
		$this->db->select('COUNT(*)');
		$query = $this->db->get($this->table_name);
		
		$row = $query->row_array();
		return ceil($row['COUNT(*)'] / $this->limit_page);
	}
	
	function get_paginator_by_category($categoryId){
		$this->db->select('COUNT(*)');
		$this->db->where('category', $categoryId);
		$query = $this->db->get($this->table_name);
	
		$row = $query->row_array();
		return ceil($row['COUNT(*)'] / $this->limit_page);
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
		$permalink = $this->permalink->permalink($storyname);
		return $this->get_story_by_permalink($permalink);
	}

	/**
	 * Get story record by storyname
	 *
	 * @param	string
	 * @return	object
	 */
	function get_story_by_permalink($permalink)
	{
		$this->db->select($this->table_name.'.*,story_info.image');
		$this->db->from($this->table_name);
		$this->db->where('LOWER(permalink)=', strtolower($permalink));
		$this->db->join('story_info', 'story_info.story = '.$this->table_name.'.id', 'left');
		
		$query = $this->db->get();
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
	function create_story($data)
	{

		if(isset($data['storyname']) && !isset($data['id'])){
			
			$data['permalink'] = $this->permalink->permalink($data['storyname']);
			
			$this->ci->load->model('categories');
			
			$re = $this->ci->categories->create_category(array('categoryname' => $data['categoryname']));
			unset($data['categoryname']);
			$data['category'] = $re['category_id'];
		}
		
		if(isset($data['description'])){
			$sql = $this->db->insert_string($this->table_name, $data) . ' ON DUPLICATE KEY UPDATE description="'.mysql_real_escape_string($data['description']).'"';
			
		} else {
			$sql = $this->db->insert_string($this->table_name, $data) . ' ON DUPLICATE KEY UPDATE updatetime="'.date('Y-m-d H:i:s').'"';
		}
		$this->db->query($sql);
		$story_id = $this->db->insert_id();
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