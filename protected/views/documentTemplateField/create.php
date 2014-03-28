<?php

$this->breadcrumb = '<li>' . CHtml::link('Document Template Field', Yii::app()->createUrl('/documentTemplateField')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>Create<span class="divider">/</span></li>';
$this->pageHeader = 'Create DocumentTemplateField';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>