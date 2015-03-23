<?php
/* @var $this FitfastTargetController */
/* @var $model FitfastTarget */

$this->breadcrumbs = array(
    'Fitfast Targets' => array('index'),
    $model->fitfastTargetId => array('view', 'id' => $model->fitfastTargetId),
    'Update',
);

$this->menu = array(
    array('label' => 'List FitfastTarget', 'url' => array('index')),
    array('label' => 'Create FitfastTarget', 'url' => array('create')),
    array('label' => 'View FitfastTarget', 'url' => array('view', 'id' => $model->fitfastTargetId)),
    array('label' => 'Manage FitfastTarget', 'url' => array('admin')),
);

$this->pageHeader = 'Update Fit and Fast Target';
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
