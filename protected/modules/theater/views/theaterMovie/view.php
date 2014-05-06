<?php
/* @var $this TheaterMovieController */
/* @var $model TheaterMovie */

$this->breadcrumbs=array(
	'Theater Movies'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TheaterMovie', 'url'=>array('admin')),
	array('label'=>'Create TheaterMovie', 'url'=>array('create')),
	array('label'=>'Update TheaterMovie', 'url'=>array('update', 'id'=>$model->theaterMovieId)),
	array('label'=>'Delete TheaterMovie', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->theaterMovieId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TheaterMovie', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View TheaterMovie #<?php echo $model->theaterMovieId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->theaterMovieId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'theaterCategoryId',
		'title',
		'description:html',
		'length',
		'url',
		array(
					'name'=>'image',
					'type'=>'image',
					'value'=>Yii::app()->baseUrl.$model->image,
				),
		array(
					'name'=>'screenshotImage',
					'type'=>'image',
					'value'=>Yii::app()->baseUrl.$model->screenshotImage,
				),
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