<?php
/**
*
* @package Konu Önizleme ( Topic Preview )
* @copyright (c) 2015 Porsuk
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tlg\konu_onizleme\acp;

class konu_onizleme_info
{
	function module()
	{
		return array(
			'filename'	=> '\tlg\konu_onizleme\acp\konu_onizleme_module',
			'title'		=> 'ACP_KONUONIZLEME',
			'modes'		=> array(
				'tp_config' => array('title' => 'ACP_KONUONIZLEME_CONFIG', 'auth' => 'ext_tlg/konu_onizleme && acl_a_board', 'cat' => array('ACP_KONUONIZLEME')),
			),
		);
	}
}
