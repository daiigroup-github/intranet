<?php
$this->breadcrumb = '<li>' . CHtml::link('Document Control Type', Yii::app()->createUrl('/documentControlType')) . '<span class="divider">/</span></li>' .
	'<li>Update</li>';
$this->pageHeader = 'Update Document Control Type : ' . $model->documentControlTypeId;
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>