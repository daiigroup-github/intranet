<?php
/* @var $this CalendarController */
/* @var $model Calendar */

$this->breadcrumbs=array(
	'Calendars'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Calendar', 'url'=>array('admin')),
	array('label'=>'Create Calendar', 'url'=>array('create')),
	array('label'=>'Update Calendar', 'url'=>array('update', 'id'=>$model->calendarId)),
	array('label'=>'Delete Calendar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->calendarId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Calendar', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View Calendar #<?php echo $model->calendarId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->calendarId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				array(
					'name'=>'status',
					'type'=>'raw',
					'value'=>$model->getStatusText($model->status),
					),
		'title',
		'description:html',
		'type',
		'date',
		'startTime',
		'endTime',
			),
		)); ?>
	</div>
</div>