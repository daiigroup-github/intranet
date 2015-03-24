<?php
/* @var $this FitfastEmployeeController */
/* @var $model FitfastEmployee */

$this->breadcrumbs=array(
	'Fitfast Employees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FitfastEmployee', 'url'=>array('index')),
	array('label'=>'Manage FitfastEmployee', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create FitfastEmployee</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>