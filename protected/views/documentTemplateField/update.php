<?php

$this->breadcrumb = '<li>' . CHtml::link('Document Template Field', Yii::app()->createUrl('/documentTemplateField')) . '<span class="divider">/</span></li>';
$this->breadcrumb .= '<li>Update<span class="divider">/</span></li>';
$this->pageHeader = 'Update DocumentTemplateField : ' . $model->documentTemplateFieldId;
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>