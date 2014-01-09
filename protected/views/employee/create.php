<?php
$this->breadcrumb = '<li>' . CHtml::link('พนักงาน', Yii::app()->createUrl('/employee')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'เพิ่มพนักงาน';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>