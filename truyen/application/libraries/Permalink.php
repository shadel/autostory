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
class Permalink
{

	function __construct()
	{
		$this->ci =& get_instance();

	}

	function permalink($title)
	{
		/* 	Replace with "-"
			Change it if you want
		*/
		
		$replacement = '-';
		$map = array();
		$quotedReplacement = preg_quote($replacement, '/');

		$default = array(
			'/Á|À|Ả|Ã|Ạ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|á|à|ã|ạ|ả|ă|ắ|ằ|ặ|ẵ|ẳ|â|ấ|ầ|ẩ|ẫ|ậ|Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ|Ã€|Ã�|áº |áº¢|Ãƒ|Ã‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´|Ã¥/' => 'a',
			'/É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»�|áº¿|á»‡|á»ƒ|á»…|Ãˆ|Ã‰|áº¸|áºº|áº¼|ÃŠ|á»€|áº¾|á»†|á»‚|á»„|Ã«/' => 'e',
			'/Í|Ì|Ỉ|Ĩ|Ị|i|í|ì|ĩ|ỉ|ị|Ã¬|Ã­|á»‹|á»‰|Ä©|ÃŒ|Ã�|á»Š|á»ˆ|Ä¨|Ã®/' => 'i',
			'/o|ó|Ó|ò|Ò|ỏ|Ỏ|õ|Õ|ọ|Ọ|ô|Ô|ố|Ố|ổ|Ổ|ỗ|Ỗ|ồ|Ồ|ộ|Ộ|ơ|Ơ|ớ|Ớ|ờ|Ờ|ở|Ở|ỡ|Ỡ|ợ|Ợ|Ã²|Ã³|á»�|á»�|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»�|á»›|á»£|á»Ÿ|á»¡|Ã’|Ã“|á»Œ|á»Ž|Ã•|Ã”|á»’|á»�|á»˜|á»”|á»–|Æ |á»œ|á»š|á»¢|á»ž|á» |Ã¸/' => 'o',
			'/Ú|ú|Ù|ù|Ủ|ủ|Ũ|ũ|Ụ|ụ|Ư|ư|Ứ|ứ|Ừ|ừ|Ử|ử|Ữ|ữ|Ự|ự|Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯|Ã™|Ãš|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®|Å¯|Ã»/' => 'u',
			'/Ý|ý|Ỳ|ỳ|Ỷ|ỷ|Ỹ|ỹ|Ỵ|ỵ|á»³|Ã½|á»µ|á»·|á»¹|á»²|Ã�|á»´|á»¶|á»¸/'	=> 'y',
			'/Đ|đ|Ä‘|Ä�/' => 'd',
			'/Ã§/' => 'c',
			'/Ã±/' => 'n',
			'/Ã¤|Ã¦/' => 'ae',
			'/Ã¶/' => 'oe',
			'/Ã¼/' => 'ue',
			'/Ã„/' => 'Ae',
			'/Ãœ/' => 'Ue',
			'/Ã–/' => 'Oe',
			'/ÃŸ/' => 'ss',
			'/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
			'/\\s+/' => $replacement,
			sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
		);
		//Some URL was encode, decode first
		$title = urldecode($title);
		
		$map = array_merge($map, $default);
		return strtolower( preg_replace(array_keys($map), array_values($map), $title) );
    #---------------------------------o
	}
}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */