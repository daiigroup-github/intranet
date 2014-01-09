<?php
/* @var $this ElearningController */
/* @var $model Elearning */

$this->breadcrumbs = array(
	'Elearnings'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List Elearning',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage Elearning',
		'url'=>array(
			'admin')),
);
?>

<h1>Create Elearning</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>