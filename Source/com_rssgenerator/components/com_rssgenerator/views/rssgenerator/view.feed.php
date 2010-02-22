<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
 
//Имя класса >>> Имя_компонента+View+Имя_класса
class RssGeneratorViewRssGenerator extends JView
{
 
function display($tpl = null)
    {
        //загружаем модель
		$model = &$this->getModel();
		
		//вызываем из нее метод >>> getRss()
        $rss = $model->getRss();
		
		//устанавливаем полученные данные из модели в переменную
        $this->assignRef( 'rss', $rss );
 
        parent::display($tpl);
    }
}
 
?>