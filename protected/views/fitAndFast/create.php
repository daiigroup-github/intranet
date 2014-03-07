<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */

$this->breadcrumbs=array(
	'Fit And Fasts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FitAndFast', 'url'=>array('index')),
	array('label'=>'Manage FitAndFast', 'url'=>array('admin')),
);
?>

<h1>Create FitAndFast</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>