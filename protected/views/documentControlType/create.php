<?php

$this->breadcrumb = '<li>' . CHtml::link('Document Control Type', Yii::app()->createUrl('/documentControlType')) . '<span class="divider">/</span></li>' .
	'<li>Create</li>';
$this->pageHeader = 'Create Document Control Type';
?>

<?php

echo $this->renderPartial('_form', array(
	'model' => $model));
?>