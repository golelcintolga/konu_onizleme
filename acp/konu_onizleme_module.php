<?php
/**
*
* @package Konu Önizleme ( Topic Preview )
* @copyright (c) 2015 Porsuk
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
namespace tlg\konu_onizleme\acp;

class konu_onizleme_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $template, $user;

		$this->page_title = $user->lang('ACP_KONUONIZLEME');
		$this->tpl_name = 'konu_onizleme';
		
		add_form_key('acp_tp');

	  	$submit 	= (isset($_POST['submit'])) ? true : false;
		if ($submit)
		{
			if (!check_form_key('acp_tp'))
			{
				trigger_error('FORM_INVALID');
			}

			set_config('tp_index', request_var('tp_index', 1));
			set_config('tp_post', request_var('tp_post', 1));
			set_config('tp_avatar_height', request_var('tp_avatar_height', 35));
			set_config('tp_word_limit', request_var('tp_word_limit', 220));
			
			trigger_error($user->lang['UPDATE_CONFIG'] . adm_back_link($this->u_action));
		}
		
		$template->assign_vars(array(
			'TP_INDEX'	=> $config['tp_index'],
			'TP_POST'	=> $config['tp_post'],
			'TP_AVATAR_HEIGHT'	=> $config['tp_avatar_height'],
			'TP_WORD_LIMIT'	=> $config['tp_word_limit'],
			
			'U_ACTION'	=> $this->u_action,
		));
	}
	
}