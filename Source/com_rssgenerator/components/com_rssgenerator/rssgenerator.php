<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
 
require_once( JPATH_COMPONENT.DS.'controller.php' );

// Проверка или требуется определенный контроллер
if($controller = JRequest::getVar( 'controller' )) {
    require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php' );
}

// Создание класса нашего компонента
$classname    = 'RssGeneratorController'.$controller;
$controller   = new $classname( );

$controller->execute(JRequest::getVar('task'));

$controller->redirect();
?>