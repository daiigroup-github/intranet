<?php
/* @var $this FitfastTargetController */
/* @var $model FitfastTarget */

$this->breadcrumbs=array(
	'Fitfast Targets'=>array('index'),
	$model->fitfastTargetId,
);

$this->menu=array(
	array('label'=>'List FitfastTarget', 'url'=>array('index')),
	array('label'=>'Create FitfastTarget', 'url'=>array('create')),
	array('label'=>'Update FitfastTarget', 'url'=>array('update', 'id'=>$model->fitfastTargetId)),
	array('label'=>'Delete FitfastTarget', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fitfastTargetId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FitfastTarget', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		View FitfastTarget #<?php echo $model->fitfastTargetId; ?>		<div class="pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i> Create', $this->createUrl('create'), array('class'=>'btn btn-xs btn-primary'));?>
		</div>
	</div>
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),
		'attributes'=>array(
			'fitfastTargetId',
		'status',
		'createDateTime',
		'updateDateTime',
		'employeeId',
		'fitfastId',
		'month',
		'target',
		'file',
		'grade',
		'parentId',
		),
	)); ?>
</div>
