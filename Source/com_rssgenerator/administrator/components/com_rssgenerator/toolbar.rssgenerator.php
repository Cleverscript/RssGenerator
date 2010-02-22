<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );



require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch ($task)
{
	case 'add'  :
		TOOLBAR_rssgenerator::_EDIT(false);
		break;
	case 'edit' :
	case 'editA':
		TOOLBAR_rssgenerator::_EDIT(true);
		break;

	default:
		TOOLBAR_rssgenerator::_DEFAULT();
		break;
}
?>
