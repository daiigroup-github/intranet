<?php
/* @var $this TheaterShowtimeController */
/* @var $model TheaterShowtime */

$this->breadcrumbs=array(
	'Theater Showtimes'=>array('index'),
	$model->theaterShowtimeId,
);

$this->menu=array(
	array('label'=>'List TheaterShowtime', 'url'=>array('admin')),
	array('label'=>'Create TheaterShowtime', 'url'=>array('create')),
	array('label'=>'Update TheaterShowtime', 'url'=>array('update', 'id'=>$model->theaterShowtimeId)),
	array('label'=>'Delete TheaterShowtime', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->theaterShowtimeId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TheaterShowtime', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View TheaterShowtime #<?php echo $model->theaterShowtimeId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->theaterShowtimeId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'theaterId',
		'theaterMovieId',
		'showDate',
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