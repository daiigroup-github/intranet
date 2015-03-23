<?php
/* @var $this ManageController */
/* @var $model FitAndFast */

$this->breadcrumb = '<li>' . CHtml::link('Manage Fit And Fast', $this->createUrl('index')) . '<span class="divider">/</span> Create</li>';

$this->pageHeader = 'Create FitAndFast';
?>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'fitfastEmployeeModel' => $fitfastEmployeeModel,
    'fitfastTargetModel' => $fitfastTargetModel,
    'targets' => $targets,
));
?>
