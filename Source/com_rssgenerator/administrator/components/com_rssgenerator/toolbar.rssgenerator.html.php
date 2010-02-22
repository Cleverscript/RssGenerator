<?php
defined( '_JEXEC' ) or die( 'Restricted access' );


class TOOLBAR_rssgenerator
{
	/**
	* 
	*/

	function _DEFAULT() {
         JToolBarHelper::title(JText::_('RSS Generator'), 'generic.png');
		//JToolBarHelper::preferences('com_pdf2email', '340');
                JToolBarHelper::save();
				JToolBarHelper::Apply();
				JToolBarHelper::Cancel();
				

		
	}
}
?>