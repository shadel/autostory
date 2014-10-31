<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('simple_html_dom.php');

/**
 * Data_api
 *
 * Authentication library for Code Igniter.
 *
 * @package		Data_api
 * @author		Shadel
 * @version		1.0.0
 */
class Data_api
{
	var $url_target = "truyen.hixx.info";
	var $url_target_rss = "truyen.hixx.vn";
	var $url_current = "tuyetbut.com";
	
	var $tmp_url_home = "http://truyen.hixx.info/truyen.html";
	var $tmp_url_home_paging = "http://truyen.hixx.info/truyen/page/{limit}";
	var $tmp_url_category = "http://truyen.hixx.info/truyen/{id}";
	var $tmp_url_category_paging = "http://truyen.hixx.info/truyen/{id}/page/{limit}";
	var $tmp_url_story = "http://truyen.hixx.info/truyen/truyen-kiem-hiep/{id}/Truyen-Kiem.html";
	var $tmp_url_story_paging = "http://truyen.hixx.info/truyen/truyen-kiem-hiep/{id}/Truyen-Kiem/index{limit}.html";
	var $tmp_url_chapter = "http://truyen.hixx.info/truyen/truyen-kiem-hiep/{id}/Truyen-Kiem/Chuong-1-Tan-mach-bam-sinh.html";
	var $tmp_url_rss = "http://truyen.hixx.info/rss/{id}.rss";
	
	var $tmp_id = "{id}";
	var $tmp_limit = "{limit}";
	
	var $type = array(
			'home' => 0,
			'category' => 1,
			'story' => 2,
			'chapter' => 3,
			'rss' => 4);

	function __construct()
	{
		$this->ci =& get_instance();

	}
	

	function get_data($url) {
	 return file_get_html($url);
	}
	
	function get_query($type, $id = null, $limit = 0) {
		
			switch ($type) {
				// home
				case 0: return str_replace($this->tmp_limit, $limit, $this->tmp_url_home_paging);
				// category
				case 1: {
					$url = str_replace($this->tmp_id, $id, $this->tmp_url_category_paging);
					return str_replace($this->tmp_limit, $limit, $url);
				}
				// story
				case 2: {
					if ($limit == 0) {
						return str_replace($this->tmp_id, $id, $this->tmp_url_story);
					}
					$url = str_replace($this->tmp_id, $id, $this->tmp_url_story_paging);
					return str_replace($this->tmp_limit, $limit, $url);
				}
				// chapter
				case 3: return str_replace($this->tmp_id, $id, $this->tmp_url_chapter);
				case 4: return str_replace($this->tmp_id, $id, $this->tmp_url_rss);
		}
	}
	
	function get_link($url) {
		return str_replace($this->url_target, $this->url_current, $url);
	}
	
	function get_home($limit = 0) {
		$url = $this->get_query($this->type['home'], null, $limit);
		$rowData = $this->get_data($url);
		
		$story_list = array();
		
		foreach ($rowData->find('#kiemhiep .content li') as $element) {
			$a = $element->find('a');
			$a_category = $a[0];
			$a_story = $a[1];
			$a_chapter = $a[2];
			$a_status = $a[3];
			$is_new = false;
			if ($element->find('img') != null) {
				$is_new = true;
			}
			$story = array(
					'category_name' => $a_category->innertext,
					'category_link' => $this->get_link($a_category->href),
					'story_name' => $a_story->innertext,
					'story_link' => $this->get_link($a_story->href),
					'chapter_name' => $a_chapter->innertext,
					'chapter_link' => $this->get_link($a_chapter->href),
					'status' => $a_status->innertext,
					'is_new' => $is_new
					);
			array_push($story_list, $story);
		}
		
		$paging = array();
		
		foreach ($rowData->find('.bt_pagination div') as $item) {
			$page = array();
			$page['name'] = $item->plaintext;
			$page['class'] = $item->class;
			
			$link = $item->find('a');
			if ($link != null) {
				$page['link'] = $this->get_link($link[0]->href);
			}
			
			array_push($paging, $page);
		}
		
		$data = array(
				'story_list' => $story_list,
				'paging' => $paging,
				'page' => $limit/50 + 1);		
		$data = $this->get_meta($data, $rowData);
		return $data;
	
	}
	
	function get_category($category, $limit = 0) {
		$url = $this->get_query($this->type['category'], $category, $limit);
		$rowData = $this->get_data($url);
		
		$story_list = array();
		
		foreach ($rowData->find('#content_left .bg .top li') as $element) {
			$a = $element->find('a');
			$a_story = $a[0];
			$a_chapter = $a[1];
			$a_status = $a[2];
			$is_new = false;
			if ($element->find('img') != null) {
				$is_new = true;
			}
			$story = array(
					'story_name' => $a_story->innertext,
					'story_link' => $this->get_link($a_story->href),
					'chapter_name' => $a_chapter->innertext,
					'chapter_link' => $this->get_link($a_chapter->href),
					'status' => $a_status->innertext,
					'is_new' => $is_new
			);
			array_push($story_list, $story);
		}
		
		$paging = array();
		
		foreach ($rowData->find('.bt_pagination div') as $item) {
			$page = array();
			$page['name'] = $item->plaintext;
			$page['class'] = $item->class;
				
			$link = $item->find('a');
			if ($link != null) {
				$page['link'] = $this->get_link($link[0]->href);
			}
				
			array_push($paging, $page);
		}
		
		$category_name = $rowData->find('.main_menu .selectedtab');
		$category_name = $category_name[0]->plaintext;
		
		$data = array(
				'category_name' => $category_name,
				'story_list' => $story_list,
				'paging' => $paging,
				'page' => $limit/50 + 1);
		$data = $this->get_meta($data, $rowData);
		return $data;
		
		
	}
	
	function get_story($id, $limit = 0) {
		$url = $this->get_query($this->type['story'], $id, $limit);
		
		$rowData = $this->get_data($url);
	
		$story_img = $rowData->find('.image img', 0)->src;
		$story_name = $rowData->find('.title', 0)->plaintext;
	
		$a_author = $rowData->find('.author a');
		$author_name = $a_author[0]->plaintext;
		$category_name = $a_author[1]->plaintext;
		$category_link = $this->get_link($a_author[1]->href);
		$status = $a_author[2]->plaintext;
		
		$description = $rowData->find('.desc', 0)->innertext;
		
		$chapter_news = array();
		
		$first_chapter = $rowData->find('.truyen_khac', 0)->next_sibling();
		
		while ($first_chapter->class == 'danh_sach') {
			array_push($chapter_news, array(
				'chapter_name' => $this->split_chapter_name($first_chapter->find('a', 0)->plaintext),
				'chapter_link' => $this->get_link($first_chapter->find('a', 0)->href)
			));
			$first_chapter = $first_chapter->next_sibling();
		}
		
		$chapter_list = array();
		
		$first_chapter = $rowData->find('.bt_pagination', 0);
		
		if ($first_chapter != null) {
			$first_chapter = $first_chapter->next_sibling();
		} else {
			$first_chapter = $rowData->find('.danh_sach', 0);
		}
		
		
		while ($first_chapter->class == 'danh_sach') {
			array_push($chapter_list, array(
			'chapter_name' => $this->split_chapter_name($first_chapter->find('a', 0)->plaintext),
			'chapter_link' => $this->get_link($first_chapter->find('a', 0)->href)
			));
			$first_chapter = $first_chapter->next_sibling();
		}
		
		$paging = array();
		
		$pagingNode = $rowData->find('.bt_pagination', 0);
		
		if ($pagingNode != null) {
			foreach ($pagingNode->find('div') as $item) {
				$page = array();
				$page['name'] = $item->plaintext;
				$page['class'] = $item->class;
			
				$link = $item->find('a');
				if ($link != null) {
					$page['link'] = $this->get_link($link[0]->href);
				}
			
				array_push($paging, $page);
			}
		}
		
	
		$data = array(
				'story_img' => $story_img,
				'story_name' => $story_name,
				'author_name' => $author_name,
				'category_name' => $category_name,
				'category_link' => $category_link,
				'status' => $status,
				'description' => $description,
				'chapter_news' => $chapter_news,
				'chapter_list' => $chapter_list,
				'paging' => $paging,
				'page' => $limit/50 + 1);
		$data = $this->get_meta($data, $rowData);
		return $data;
	}
	
	function split_chapter_name($chapter_name) {
		$name = explode('--', $chapter_name);
		return $name[2];
	}
	
	function get_chapter($id) {
		$url = $this->get_query($this->type['chapter'], $id);
		$rowData = $this->get_data($url);
	
		$category = $rowData->find('.link_path_nhom', 0)->find('a', 1);
		$category_name = $category->plaintext;
		$category_link = $this->get_link($category->href);
		
		$story = $rowData->find('.path', 0)->find('a', 0);
		$story_name = $story->plaintext;
		$story_link = $this->get_link($story->href);
		
		$chapter_name = str_replace($story, "", $rowData->find('.path', 0));
		$contentData = $rowData->find('.chi_tiet', 0);
		
		$content = str_replace($contentData->first_child(), "", $contentData);
		$content = str_replace("<p>&nbsp;</p><p>&nbsp;</p>", "<p>&nbsp;</p>", $content);
		
		$scripts = $rowData->find('script[type="text/javascript"]');
		$page_script = array();
		foreach ($scripts as $script) {
			if (strpos($script, 'page_next') > 0) {
				array_push($page_script, $this->get_link($script));
			} else if (strpos($script, 'arr_image') > 0) {
				$image_script = str_replace("//", "", $script);
				$image_script = str_replace("http:", "http://", $image_script);
				array_push($page_script, $image_script);
			}
		}
		
		$data = array(
				'category_name' => $category_name,
				'category_link' => $category_link,
				'story_name' => $story_name,
				'story_link' => $story_link,
				'chapter_name' => $chapter_name,
				'scripts' => $page_script,
				'body' => $content);
		
		$convert = $rowData->find('td[align="center"]', 1)->find('a', 0);
		
		if (isset($convert)) {
				
			$data['convert_name'] = $convert->plaintext;
			$data['convert_link'] = $this->get_link($convert->href);
		}
		
		$data = $this->get_meta($data, $rowData);
		
		return $data;
	
	}
	
	function get_meta($data, $rowData) {
		$meta = array();
		$meta['description'] = $rowData->find('meta[name="description"]', 0)->content;
		$meta['keywords'] = $rowData->find('meta[name="keywords"]', 0)->content;
		$data['meta'] = $meta;
		
		$title = $rowData->find('title', 0)->innertext;
		$data['title'] = $title;
		return $data;
	}
	
	function get_rss($id) {
	
		$url = $this->get_query($this->type['rss'], $id);
		$rowData = $this->get_data($url);
	
		$data = str_replace($this->url_target, $this->url_current, $rowData);
		
		$data = str_replace($this->url_target_rss, $this->url_current, $data);
		
		return $data;
	
	}

}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */