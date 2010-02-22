<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
jimport('joomla.document.html.html');
/*$renderer = JPATH_SITE.DS.'libraries/joomla/document/feed/renderer/rss.php';
$feed = JPATH_SITE.DS.'libraries/joomla/document/feed/feed.php';
include_once($renderer);
include_once($feed);*/
//Имя класса >>> Имя_компонента+View+Имя_класса
class RssGeneratorViewRssGenerator extends JView
{

function display()
    {
	global $mainframe;
	$path_to_file = JPATH_SITE.DS."components/com_rssgenerator".DS."rss.xml";
	define ("PATH_REDIRECT", "/components/com_rssgenerator/rss.xml");
	define ("PATH_BLOCKFILE", JPATH_SITE.DS."components/com_rssgenerator".DS."blocked.txt");
	define ("PATH_TEMPFILE", JPATH_SITE.DS."components/com_rssgenerator".DS."temp.php");
	

    //загружаем модель
	$model = &$this->getModel();

	//вызываем из нее метод >>> getRss()
        $data = $model->getRss();

	//create feed
	$count = count($data);
//echo $count;
        $header = '<?xml version="1.0" encoding="utf-8"?>';
		$header = '<?xml-stylesheet href="/templates/rss/rss2full.xsl" type="text/xsl" media="screen"?>';
        $header.='<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">';
        $header.='<channel>';
        $header.='<language>ru</language>';
        $header.='<title>Cleverscript</title>';
        $header.='<link>'.JPATH_SITE.'</link>';
        $header.='<description>cleveerscript.ru</description>';
        $footer .= '</channel></rss>';

    $lock = fopen(PATH_BLOCKFILE,"a");
	if(flock($lock, LOCK_EX)) {
		$tmp=fopen(PATH_TEMPFILE,"w");

		$items = array();
		$i=0;
		foreach($data as $rss) {
			$feed = '<item>';
			$feed .= '<title>'.$rss->title.'</title>';
			$feed .= '<link>'.$rss->link.'</link>';
                        $feed .= '<guid>'.$rss->link.'</guid>';
                        $feed .= '<description><![CDATA['.$rss->introtext.']]></description>';
			$feed .= '<pubDate>'.$rss->date.'</pubDate>';
			$feed .= '</item>';

			array_push($items, $feed);
			$itms = implode($items);
			$xml = $header.$itms.$footer;
			$i++;
		}
		fputs($tmp, "$xml");
		//close temp file
		fclose($tmp);
		//delete this file
		unlink("$path_to_file");
		//rename temp file 
		rename(PATH_TEMPFILE, "$path_to_file");
		//unbloked bloked file
		flock($lock, LOCK_UN);
		//close bloked file
		fclose($lock);
		//redirect to xml rss feed
        $mainframe->redirect(PATH_REDIRECT);
        //print_r($params);
	}

    }
}
?>
