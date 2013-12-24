<?php

$this->pageHeader = 'แก้ไขประเภทเอกสาร : ' . $model->documentTypeName;
;
$this->breadcrumb = '<li>' . CHtml::link('การจัดการประเภทเอกสาร', Yii::app()->createUrl('/documentType')) . '<span class="divider">/</span></li><li>แก้ไขประเภทเอกสาร</li>';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model,
	'documentTemplate' => $documentTemplate,));
?>