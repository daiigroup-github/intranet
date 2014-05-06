<?php
/* @var $this TheaterController */
/* @var $model Theater */

$this->breadcrumbs=array(
	'Theaters'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Theater', 'url'=>array('admin')),
	array('label'=>'Create Theater', 'url'=>array('create')),
	array('label'=>'Update Theater', 'url'=>array('update', 'id'=>$model->theaterId)),
	array('label'=>'Delete Theater', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->theaterId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Theater', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View Theater #<?php echo $model->theaterId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->theaterId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'title',
		'description:html',
		'seats',
		'staffId',
		'startTime',
		'endTime',
		array(
					'name'=>'status',
					'type'=>'raw',
					'value'=>$model->getStatusText($model->status),
					),
		'createDateTime',
		'updateDateTime',
			),
		)); ?>
	</div>
</div>