<?php
/* @var $this ApplicationController */
/* @var $model EmployeeInfo */

$this->breadcrumbs = array(
	'Employee Infos' => array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label' => 'List EmployeeInfo',
		'url' => array(
			'index')),
	array(
		'label' => 'Manage EmployeeInfo',
		'url' => array(
			'admin')),
);
?>

<h1>Create EmployeeInfo</h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>