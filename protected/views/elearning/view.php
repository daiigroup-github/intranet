<?php
/* @var $this ElearningController */
/* @var $model Elearning */

$this->breadcrumbs=array(
	'Elearnings'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Elearning', 'url'=>array('index')),
	array('label'=>'Create Elearning', 'url'=>array('create')),
	array('label'=>'Update Elearning', 'url'=>array('update', 'id'=>$model->elearningId)),
	array('label'=>'Delete Elearning', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->elearningId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Elearning', 'url'=>array('admin')),
);
?>

<h1>View Elearning #<?php echo $model->elearningId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'elearningId',
		'title',
		'description:html',
		'parentId',
	),
)); ?>
