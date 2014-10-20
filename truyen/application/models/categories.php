<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Stories
 *
 * This model represents category data. It operates the following tables:
 * - category data,
 * - category translations
 *
 * @author Shadel
 */
class Categories extends CI_Model
{
	private $table_name			= 'categories';			// categories

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
	function get_categories()
	{
	
		$query = $this->db->get($this->table_name);
		if ($query->num_rows()) return $query->result();
		return NULL;
	}
	
	/**
	 * Get category record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_category_by_id($category_id)
	{
		$this->db->where('id', $category_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get category record by categoryname
	 *
	 * @param	string
	 * @return	object
	 */
	function get_category_by_categoryname($categoryname)
	{
		$this->db->where('LOWER(categoryname)=', strtolower($categoryname));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get category record by categoryname
	 *
	 * @param	string
	 * @return	object
	 */
	function get_category_by_permalink($permalink)
	{
		$this->db->where('LOWER(permalink)=', strtolower($permalink));
	
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	/**
	 * Create new category record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_category($data)
	{

		$data['permalink'] = $this->permalink->permalink($data['categoryname']);
		$category = $this->get_category_by_permalink($data['permalink']);
		
		if($category){
			return array('category_id' => $category->id);
		}
		if ($this->db->insert($this->table_name, $data)) {
			$category_id = $this->db->insert_id();
			return array('category_id' => $category_id);
		}
		return NULL;
	}

	/**
	 * Delete category record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_category($category_id)
	{
		$this->db->where('id', $category_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_translations($category_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Update category login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function update_category($category_id, $data)
	{
		$this->db->where('id', $category_id);
		$this->db->update($this->table_name, $data);
	}

}

/* End of file categorys.php */
/* Location: ./application/models/categories.php */