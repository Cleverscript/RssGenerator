RssGenerator
=============
RssGenerator - a component for Joomla 1.5! buyout allows you to create RSS news to your website or blog, includes com_rssgenerator and mod_rssgnerator

How to Use
-------------
Set com_rssgenerator as a normal component of joomla, then set mod_rssgenerator as a normal module, and configure it.

#PHP
<?php
class RssGeneratorViewRssGenerator extends JView
{
function display()
    {
	global $mainframe;
	$path_to_file = JPATH_SITE.DS."components/com_rssgenerator".DS."rss.xml";
	define ("PATH_REDIRECT", "/components/com_rssgenerator/rss.xml");
	define ("PATH_BLOCKFILE", JPATH_SITE.DS."components/com_rssgenerator".DS."blocked.txt");
	define ("PATH_TEMPFILE", JPATH_SITE.DS."components/com_rssgenerator".DS."temp.php");
	

    //get Model
	$model = &$this->getModel();

	//get Rss mezood
        $data = $model->getRss();

	//create feed
	$count = count($data);

        $header = '<?xml version="1.0" encoding="utf-8"?>';
		$header = '<?xml-stylesheet href="/templates/rss/rss2full.xsl" type="text/xsl" media="screen"?>';
        $header.='<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">';
        $header.='<channel>';
        $header.='<language>ru</language>';
        $header.='<title>Cleverscript</title>';
        $header.='<link>'.JPATH_SITE.'</link>';
        $header.='<description>site name</description>';
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
Screenshots
-----------

This section is optional, but encouraged if the plugin affords it. Just a list of images, one per line. We do the resizing, so use actual size screenshots.

![Screenshot 1](http://cleverscript.ru/images/mootools/forge/PageMooSlider/rssgen.gif)

Arbitrary section
-----------------

home page progect: http://cleverscript.ru/index.php/cms/joomla