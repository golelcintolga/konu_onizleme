<?php

/**
*
* @package  Konu Önizleme ( Topic Preview )
* @copyright (c) 2015 Porsuk
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tlg\konu_onizleme\core;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

class konu_onizleme
{
	protected $config;
	protected $template;
	protected $user;
	protected $request;
	protected $db;
	protected $root_path;
	protected $phpEx;

	public function __construct(\phpbb\config\config $config, \phpbb\template\twig\twig $template, \phpbb\user $user, \phpbb\request\request $request, \phpbb\db\driver\driver_interface $db, $root_path, $php_ext)
	{
		$this->config			= $config;
		$this->template			= $template;
		$this->user				= $user;
		$this->request	= $request;
		$this->db				= $db;
		$this->root_path		= $root_path;
		$this->phpEx			= $php_ext;
	}

	public function display_konuonizleme($tpl_loopname = 'konuonizleme')
	{
	
	$this->user->add_lang_ext("tlg/konu_onizleme", "konuonizleme");
	
	$action = request_var('f', '');
	$onizle = request_var('onizle', '');
	$onizle2 = request_var('onizle2', 0);

	$ayar = $this->config['tp_post'];
	$limit = $this->config['tp_word_limit'];
	$width = $this->config['tp_avatar_height'];
	$height = $this->config['tp_avatar_height'];

	$regex = array(
		'#\[/?[^\[\]]+\]#mi',
		'#<[^>]*>(.*<[^>]*>)?#Usi',
	);
$sql_select = 'SELECT p.post_id, p.topic_id, p.forum_id, p.poster_id, p.post_time, p.post_postcount, p.post_text, p.bbcode_bitfield, p.bbcode_uid, u.user_id, u.username, u.user_colour, u.user_avatar, u.user_avatar_type';

if ($this->request->is_ajax())
{
	if(1 == $ayar or  3 == $ayar){
	$sql=	$sql_select . '
				FROM ' . POSTS_TABLE .' p
				LEFT JOIN ' . USERS_TABLE ." u
					ON p.poster_id=u.user_id
				WHERE p.topic_id = $onizle ORDER BY p.post_time ASC LIMIT 1";
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$text = preg_replace($regex, '$1', $row['post_text']);
			$text_sayim = utf8_strlen($text);
			if($text_sayim > $limit){
				$new_text = utf8_substr($text, 0, $limit).'...';
			}else{
				$new_text = $text;
			}
			$tp_first = array(
					'POST_ID'	=> $row['post_id'],
					'POST_TEXT'	=> censor_text($new_text),
					'POST_AUTHOR'=> get_username_string('no_profile', $row['poster_id'], $row['username'], $row['user_colour']),
					'AVATAR'		=> ($this->user->optionget('viewavatars')) ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $width, $height) : '',
					'U_VIEW_POST'	=> append_sid("{$this->root_path}viewtopic.$this->phpEx","f=".$action."&amp;t=".$onizle."&amp;p=".$row['post_id'].'#p'.$row['post_id']),
					'TEKMESAJ' =>true,
			);
		}
		$this->db->sql_freeresult($result);
	}

	if(2 == $ayar or 3 == $ayar && $onizle2 > 0){
				$sql=	$sql_select . '
				FROM ' . POSTS_TABLE .' p
				LEFT JOIN ' . USERS_TABLE ." u
					ON p.poster_id=u.user_id
				WHERE p.topic_id = $onizle ORDER BY p.post_time DESC LIMIT 1";
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$text = preg_replace($regex, '$1', $row['post_text']);
			$text_sayim = utf8_strlen($text);
			if($text_sayim > $limit){
				$new_text = utf8_substr($text, 0, $limit).'...';
			}else{
				$new_text = $text;
			}
				$tp_last = array(
					'POST_ID'	=> $row['post_id'],
					'POST_TEXT'	=> censor_text($new_text),
					'POST_AUTHOR'=> get_username_string('no_profile', $row['poster_id'], $row['username'], $row['user_colour']),
					'AVATAR'		=> ($this->user->optionget('viewavatars')) ? get_user_avatar($row['user_avatar'], $row['user_avatar_type'], $width, $height) : '',
					'U_VIEW_POST'	=> append_sid("{$this->root_path}viewtopic.$this->phpEx","f=".$action."&amp;t=".$onizle."&amp;p=".$row['post_id'].'#p'.$row['post_id']),
					'TEKMESAJ' =>true,
				);
		}
		$this->db->sql_freeresult($result);
	}
	$json_response = new \phpbb\json_response();
		if(1 == $ayar){
			$json_response->send($tp_first);
		}elseif(2 == $ayar){
			$json_response->send($tp_last);
		}elseif(3 == $ayar && $onizle2 > 0){
			$json_response->send([$tp_first,$tp_last]);
		}else{
			$json_response->send($tp_first);
		}
	}

			$this->template->assign_vars(array(
				'U_CALIS' => append_sid("{$this->root_path}viewforum.$this->phpEx?f=$action"),

				strtoupper($tpl_loopname) . '_DISPLAY' => true,
			));
	}
}