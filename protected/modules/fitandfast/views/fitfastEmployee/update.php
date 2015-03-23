<?php
/* @var $this FitfastEmployeeController */
/* @var $model FitfastEmployee */

$this->breadcrumbs=array(
	'Fitfast Employees'=>array('index'),
	$model->fitfastEmployeeId=>array('view','id'=>$model->fitfastEmployeeId),
	'Update',
);

$this->menu=array(
	array('label'=>'List FitfastEmployee', 'url'=>array('index')),
	array('label'=>'Create FitfastEmployee', 'url'=>array('create')),
	array('label'=>'View FitfastEmployee', 'url'=>array('view', 'id'=>$model->fitfastEmployeeId)),
	array('label'=>'Manage FitfastEmployee', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update FitfastEmployee <?php echo $model->fitfastEmployeeId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>