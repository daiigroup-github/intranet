<?php
$this->breadcrumbs = array(
	'Employee Levels'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List EmployeeLevel',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage EmployeeLevel',
		'url'=>array(
			'admin')),
);
?>

<h1>Create EmployeeLevel</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>