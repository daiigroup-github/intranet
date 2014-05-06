<?php
/* @var $this TheaterCategoryController */
/* @var $model TheaterCategory */

$this->breadcrumbs=array(
	'Theater Categories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TheaterCategory', 'url'=>array('admin')),
	array('label'=>'Create TheaterCategory', 'url'=>array('create')),
	array('label'=>'Update TheaterCategory', 'url'=>array('update', 'id'=>$model->theaterCategoryId)),
	array('label'=>'Delete TheaterCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->theaterCategoryId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TheaterCategory', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>View TheaterCategory #<?php echo $model->theaterCategoryId; ?></h3>
	</div>
	<div class="module-option clearfix">
		<div class="btn-group pull-right">
			<?php echo CHtml::link('<i class="icon-plus-sign"></i>', $this->createUrl('create'), array('class'=>'btn btn-small btn-primary'));?>
			<?php echo CHtml::link('<i class="icon-edit"></i>', $this->createUrl('update', array('id'=>$model->theaterCategoryId)), array('class'=>'btn btn-small btn-warning'));?>
		</div>
	</div>
	<div class="module-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'table table-striped table-border table-hover', 'style'=>'margin-top:20px;'),
			'attributes'=>array(
				'title',
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