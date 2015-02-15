<?php
/**
*
* @package Konu Önizleme ( Topic Preview )
* @copyright (c) 2015 Porsuk
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tlg\konu_onizleme\migrations;
		
class version_1_0_0 extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('tp_index', '1')),
			array('config.add', array('tp_post', '1')),
			array('config.add', array('tp_avatar_height', '35')),
			array('config.add', array('tp_word_limit', '220')),
			// Add the ACP module
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_KONUONIZLEME')),
			array('module.add', array(
				'acp', 'ACP_KONUONIZLEME', array(
					'module_basename'	=> '\tlg\konu_onizleme\acp\konu_onizleme_module',
					'modes'				=> array('tp_config'),
				),
			)),
		);
	}
}