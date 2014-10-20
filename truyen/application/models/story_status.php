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
class Story_status extends CI_Model
{
	private $table_name			= 'story_status';			// stories
	private $table_name_story			= 'story_status_story';			// stories
	private $limit_page = 50;

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->load->library('permalink');
	}

	
	
	/**
	 * Get story record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_status_by_story_id($story_id)
	{
// 		$this->db->select('*');
// 		$this->db->from($this->table_name.' as si');
// 		$this->db->where('si.story', $story_id);

// 		$query = $this->db->get();
// 		if ($query->num_rows() == 1) return $query->row();
// 		return NULL;
	}
	
	function get_status_by_permalink($permalink)
	{
		$this->db->select('*');
		$this->db->from($this->table_name.' as si');
		$this->db->where('si.permalink', $permalink);

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
	function create_story_status($data)
	{
		if(isset($data['story'])){
			$story = $data['story'];
			unset($data['story']);
		}
		
		$data['permalink'] = $this->permalink->permalink($data['name']);
		$sql = $this->db->insert_string($this->table_name, $data) . ' ON DUPLICATE KEY UPDATE name="'.($data['name']).'"';
			
		$this->db->query($sql);
		$status_id = $this->db->insert_id();
		
		if(!$status_id){
			$status_id = $this->get_status_by_permalink($data['permalink'])->id;
		}
		
		if(isset($story)){
			$sql = $this->db->insert_string($this->table_name_story, array(
					'story' => $story,
					'status' => $status_id)) . ' ON DUPLICATE KEY UPDATE status="'.($status_id).'"';
				
			$this->db->query($sql);
			return array('status_id' => $status_id);
		}
		
		
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