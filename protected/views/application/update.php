<?php
/* @var $this ApplicationController */
/* @var $model EmployeeInfo */

$this->breadcrumbs = array(
	'Employee Infos' => array(
		'index'),
	$model->ID => array(
		'view',
		'id' => $model->ID),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List EmployeeInfo',
		'url' => array(
			'index')),
	array(
		'label' => 'Create EmployeeInfo',
		'url' => array(
			'create')),
	array(
		'label' => 'View EmployeeInfo',
		'url' => array(
			'view',
			'id' => $model->ID)),
	array(
		'label' => 'Manage EmployeeInfo',
		'url' => array(
			'admin')),
);
?>

<h1>Update EmployeeInfo <?php echo $model->ID; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>