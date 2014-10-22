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
class Save extends CI_Model
{
	private $table_name			= 'save';			// save
	
	private $times = array(
			'home' => '1 days',
			'category' => '1 days',
			'story' => '1 days'
			);

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
	function get_save($type, $key = "")
	{
		$this->db->where('type', $type);
		$this->db->where('key', $key);
		
		if (isset($this->times[$type])) {
			$this->db->where('update_datetime >=', date('Y-m-d', strtotime('-'.$this->times[$type])));
		}

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	/**
	 * Create new save record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function save($data)
	{

		$sql = $this->db->insert_string($this->table_name, $data) . ' ON DUPLICATE KEY UPDATE value="'.mysql_real_escape_string($data['value']).'"';
		$this->db->query($sql);
	}

}

/* End of file storys.php */
/* Location: ./application/models/stories.php */