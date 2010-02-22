<?php
	defined('_JEXEC') or die('Restricted access');
	jimport( 'joomla.application.module.helper' );
	//параметры доступные модулю
	//print_r($params);
	
	//Получаем паремтр с именем шаблона
	$tmpl = str_replace('.php', '', $params->def('template', 'default.php'));
	
	//Подключаем наш helper и
	//и обращаемся к его классу, вызывая метод  - который возвращает нам массив обьектов
	//при этом передавая методу все параметры полученные модулем (из админки)
	require_once ('helper.php');
	$arr = Feed_Icon::getIcon($params);
	if (!count($arr)) {
		return;
	}
	
	//Подключаем шаблон (который указан из админке)
	$template = JModuleHelper::getLayoutPath('mod_rssgenerator', $tmpl);
	if (file_exists($template)) {
		require($template);
	} else {
		echo JText::_('ERROR_TEMPLATE');
	}
?>