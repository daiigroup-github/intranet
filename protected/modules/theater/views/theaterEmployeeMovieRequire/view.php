<?php
/* @var $this TheaterEmployeeMovieRequireController */
/* @var $model TheaterEmployeeMovieRequire */

$this->breadcrumbs=array(
	'Theater Employee Movie Requires'=>array('index'),
	$model->theaterEmployeeMovieRequireId,
);

$this->menu=array(
	array('label'=>'List TheaterEmployeeMovieRequire', 'url'=>array('admin')),
	array('label'=>'Create TheaterEmployeeMovieRequire', 'url'=>array('create')),
	array('label'=>'Update TheaterEmployeeMovieRequire', 'url'=>array('update', 'id'=>$model->theaterEmployeeMovieRequireId)),
	array('label'=>'Delete TheaterEmployeeMovieRequire', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->theaterEmployeeMovieRequireId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TheaterEmployeeMovieRequire', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View TheaterEmployeeMovieRequire #<?php echo $model->theaterEmployeeMovieRequireId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->theaterEmployeeMovieRequireId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'employeeId',
		'description:html',
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