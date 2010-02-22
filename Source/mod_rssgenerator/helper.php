<?php 
//defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
jimport('joomla.document.html.html');
class Feed_Icon {

	function getIcon(&$params) {
		
		global $mainframe;
		$document =& JFactory::getDocument();
		//ссылка на оригинальный фид, сформированный com_rssgenerator
		$feed = $params->get('feed');
		//сылка на feed из feedburner
		$feedburner = $params->get('feedburner');

		if($feed == 0){
			$feed_link = JRoute::_("index.php?option=com_rssgenerator&view=rssgenerator");
		}else{
			$feed_link = JRoute::_($feedburner);
		}
		
		//иконка фида
		$src = JURI::root().'modules/mod_rssgenerator/tmpl/img/rss.gif';
		//добавляем ссылку на ленту новостей в head документа
		$link   = '&format=feed&limitstart=';
        $attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
        $document->addHeadLink($feed_link, 'alternate', 'rel', $attribs);
		
		/*$attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
        $document->addHeadLink(JRoute::_($link.'&type=atom'), 'alternate', 'rel', $attribs);*/
		$arr = array();
		$arr[] = $feed_link;
		$arr[] = $src;
	//возвращаем массив объектов
	return $arr;
	}
	
}

?>