<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
 
//��� ������ >>> ���_����������+View+���_������
class RssGeneratorViewRssGenerator extends JView
{
 
function display($tpl = null)
    {
        //��������� ������
		$model = &$this->getModel();
		
		//�������� �� ��� ����� >>> getRss()
        $rss = $model->getRss();
		
		//������������� ���������� ������ �� ������ � ����������
        $this->assignRef( 'rss', $rss );
 
        parent::display($tpl);
    }
}
 
?>