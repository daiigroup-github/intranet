<?php
/* @var $this ConstructionProjectController */
/* @var $model ConstructionProject */

$this->breadcrumbs = array(
	'Construction Projects'=>array(
		'index'),
	$model->name=>array(
		'view',
		'id'=>$model->projectId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List ConstructionProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ConstructionProject',
		'url'=>array(
			'create')),
	array(
		'label'=>'View ConstructionProject',
		'url'=>array(
			'view',
			'id'=>$model->projectId)),
	array(
		'label'=>'Manage ConstructionProject',
		'url'=>array(
			'admin')),
);
?>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>