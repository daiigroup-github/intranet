<?php
$this->pageHeader = 'สร้างประเภทเอกสาร';
$this->breadcrumb = '<li>' . CHtml::link('การจัดการประเภทเอกสาร', Yii::app()->createUrl('/documentType')) . '<span class="divider">/</span></li><li>สร้างประเภทเอกสาร</li>';
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'documentTemplateField'=>$documentTemplateField,
	'documentTemplate'=>$documentTemplate));
?>