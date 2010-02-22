<?php
	defined('_JEXEC') or die('Restricted access');
    jimport( 'joomla.application.module.helper' );
	//$css = "<style type=\"text/css\">.rss_generator{}</style>";
	//$GLOBALS['mainframe']->addCustomHeadTag($css);
?>
<div class="rss_generator">
	<a target="_blank" title="Rss" class="link-feed" href="<?php echo $arr[0]; ?>">
		<img alt="Rss" src="<?php echo $arr[1]; ?>" />
	</a>
</div>