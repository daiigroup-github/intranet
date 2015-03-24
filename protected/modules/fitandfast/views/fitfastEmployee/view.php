<?php
/* @var $this FitfastEmployeeController */
/* @var $model FitfastEmployee */

$this->breadcrumbs=array(
	'Fitfast Employees'=>array('index'),
	$model->fitfastEmployeeId,
);

$this->menu=array(
	array('label'=>'List FitfastEmployee', 'url'=>array('index')),
	array('label'=>'Create FitfastEmployee', 'url'=>array('create')),
	array('label'=>'Update FitfastEmployee', 'url'=>array('update', 'id'=>$model->fitfastEmployeeId)),
	array('label'=>'Delete FitfastEmployee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fitfastEmployeeId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FitfastEmployee', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View FitfastEmployee #<?php echo $model->fitfastEmployeeId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'fitfastEmployeeId',
		'status',
		'createDateTime',
		'updateDateTime',
		'employeeId',
		'halfS',
		'S',
		'SS',
		'F',
		'forYear',
		'percent',
		),
	)); ?>
</div>
