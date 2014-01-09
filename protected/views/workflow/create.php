<?php
$this->breadcrumb = '<li>' . CHtml::link('Workflow', Yii::app()->createUrl('/workflow')) . '<span class="divider">/</span></li>';
$this->pageHeader = 'Create Workflow';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>