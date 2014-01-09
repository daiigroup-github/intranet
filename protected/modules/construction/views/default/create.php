<?php
/* @var $this ConstructionProjectController */
/* @var $model ConstructionProject */

$this->breadcrumbs = array(
	'Construction Projects'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List ConstructionProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage ConstructionProject',
		'url'=>array(
			'admin')),
);
?>

<h1>Create ConstructionProject</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>