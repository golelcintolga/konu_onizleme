<?php
/**
*
* Konu Önizleme ( Topic Preview ) for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_KONUONIZLEME' => 'Konu Önizleme',
	'ACP_KONUONIZLEME_EXPLAIN' => 'Konulara atılan mesajları önizleme yapmanızı sağlar',
	'ACP_KONUONIZLEME_CONFIG' => 'Konu Önizleme Ayarları',
	'TP_ENABLE' => 'Konu Önizleme Durumu',
	'TP_WHICH_POSTS' => 'Hangi Mesajlar Görüntülensin',
	'TP_FIRST_POST' => 'İlk Mesaj',
	'TP_LAST_POST' => 'Son Mesaj',
	'TP_BOTH_POSTS' => 'İlk ve Son Mesaj',
	'TP_AVATAR' => 'Avatar Boyutu',
	'TP_AVATAR_EXPLAIN' => 'Gösterilecek avatarın boyutunu yazınız.',
	'TP_CHARACTER_LIMIT' => 'Harf Sınırı',
	'TP_CHARACTER_LIMIT_EXPLAIN' => 'Gösterilecek mesajın harf sınırını yazınız.',
	'UPDATE_CONFIG'	=> 'Ayarlar Güncellendi',
));
