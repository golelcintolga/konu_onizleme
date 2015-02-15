<?php
/**
*
* @package  Konu Önizleme ( Topic Preview )
* @copyright (c) 2015 Porsuk
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tlg\konu_onizleme\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/* @var \tlg\konu_onizleme\core\konu_onizleme */
	protected $tp_functions;
	
	/** @var \phpbb\config\config */
	protected $config;
	
	public function __construct(\tlg\konu_onizleme\core\konu_onizleme $functions, \phpbb\config\config $config)
	{
		
		$this->tp_functions = $functions;
		$this->config = $config;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.viewforum_modify_topicrow'		=> 'display_topic_previews',
		);
	}
	
	public function display_topic_previews()
	{
		if (!$this->config['tp_index']){ return; }
		$this->tp_functions->display_konuonizleme('konuonizleme', true);
	}
}
