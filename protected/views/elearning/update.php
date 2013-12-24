<?php
/* @var $this ElearningController */
/* @var $model Elearning */

$this->breadcrumbs=array(
	'Elearnings'=>array('index'),
	$model->title=>array('view','id'=>$model->elearningId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Elearning', 'url'=>array('index')),
	array('label'=>'Create Elearning', 'url'=>array('create')),
	array('label'=>'View Elearning', 'url'=>array('view', 'id'=>$model->elearningId)),
	array('label'=>'Manage Elearning', 'url'=>array('admin')),
);
?>

<h1>Update Elearning <?php echo $model->elearningId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>