<?php
/* @var $this ManageController */
/* @var $model FitAndFast */



$this->breadcrumb = '<li>' . CHtml::link('Manage Fit And Fast', $this->createUrl('index')) . '<span class="divider">/</span> Update</li>';

$this->pageHeader = 'Update FitAndFast';
?>

<?php
$this->renderPartial('_form', array(
	'model'=>$model));
?>