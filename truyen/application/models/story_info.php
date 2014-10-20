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
class Story_info extends CI_Model
{
	private $table_name			= 'story_info';			// stories
	private $table_views			= 'story_fullinfo';			// stories
	private $limit_page = 50;

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
	}

	
	
	/**
	 * Get story record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_info_by_story_id($story_id)
	{
		$this->db->select('*');
		$this->db->from($this->table_views.' as si');
		$this->db->where('si.story', $story_id);

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
	function create_story_info($data)
	{

		$sql = $this->db->insert_string($this->table_name, $data) . ' ON DUPLICATE KEY UPDATE image="'.($data['image']).'"';
		
		$this->db->query($sql);
		$story_id = $this->db->insert_id();
		
		return array('chapter_id' => $story_id);
		
		return NULL;
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