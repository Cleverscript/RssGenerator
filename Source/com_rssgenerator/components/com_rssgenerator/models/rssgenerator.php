<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );
require_once(JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class RssGeneratorModelRssGenerator extends JModel
{
    /**
    * Gets the greeting
    * @return string The greeting to be displayed to the user
    */
    function getRSS()
    {
		global $mainframe;
		$db	=& JFactory::getDBO();
		$count = 10;

		$where = 'state = 1';
		$query = 'SELECT a.*, ' .
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(":", c.id, c.alias) ELSE c.id END as catslug'.
			' FROM #__content AS a' .
			' LEFT JOIN #__users AS u ON u.id = a.created_by' .
			' INNER JOIN #__categories AS c ON c.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE '.$where.
			' AND s.published = 1' .
			' AND c.published = 1' .
			' ORDER BY id DESC' .
			' LIMIT '.$count.'';

			//if($count == ''){
				$db->setQuery($query);
			///}else{
				//$db->setQuery($query, 0, $count);
			//}

			$rows = $db->loadObjectList();

		for($s=0; $s<count($rows);$s++){
			$data = array();
			$i=0;
			$lists	= array();
			foreach ($rows as $row) {
				//формируем ссылку
				$lists[$i]->link =  JURI::root().JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid));
				//формируем превью
				$text = strtolower($row->introtext);
				$regex	= "/<img[^>]+src\s*=\s*[\"']\/?([^\"']+)[\"'][^>]*\>/";//поиск картинки
				preg_match ($regex, $text, $matches);
				$images	= (count($matches)) ? $matches : array();
				if ($images) {
                    $img = "<a href='".$lists[$i]->link."'><img alt='".$row->title."' align='left' style='margin-left:20px;border:none;' src='".JURI::root().$images[1]."' /></a>";
					//$txt = preg_replace('/<img[^>]+\>/', '', $text, 1);

                    $full = $row->fulltext;
                    $full = preg_replace("/<p>/", "", $full);
                    $full = preg_replace("/<\/p>/", "", $full);
                    $full = iconv("utf-8", "cp1251", $full);
                    $full = substr($full, 0, 800);
                    $full = '<p>'.strip_tags($full).'...<a title="'.$row->title.'" href="'.$lists[$i]->link.'">Читать...</a></p>';
                            
                  	$lists[$i]->introtext = iconv("cp1251", "utf-8", $img.$full);
				}else{
                      $full = $row->fulltext;
                      $full = preg_replace("/<p>/", "", $full);
                      $full = preg_replace("/<\/p>/", "", $full);
                      $full = iconv("utf-8", "cp1251", $full);
                      $full = substr($full, 0, 800);
                      $full = '<p>'.strip_tags($full).'...<a title="'.$row->title.'" href="'.$lists[$i]->link.'">Читать...</a></p>';
					  
                      $lists[$i]->introtext = iconv("cp1251", "utf-8", substr($full, 0, 800));
               }
				$lists[$i]->date = $row->created;
				$lists[$i]->title = $row->title;
				$lists[$i]->author = 'cleverscript.ru';

				$i++;
			}

			return $lists;
			array_push($data, $lists);
		}

    }
}
?>

