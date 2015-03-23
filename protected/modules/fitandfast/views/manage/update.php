<?php
/* @var $this ManageController */
/* @var $model Fitfast */

$this->breadcrumbs=array(
	'Fitfasts'=>array('index'),
	$model->title=>array('view','id'=>$model->fitfastId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Fitfast', 'url'=>array('index')),
	array('label'=>'Create Fitfast', 'url'=>array('create')),
	array('label'=>'View Fitfast', 'url'=>array('view', 'id'=>$model->fitfastId)),
	array('label'=>'Manage Fitfast', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		Update Fitfast <?php echo $model->fitfastId; ?>	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>