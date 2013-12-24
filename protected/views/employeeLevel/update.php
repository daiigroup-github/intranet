<?php
$this->breadcrumbs = array(
	'Employee Levels' => array(
		'index'),
	$model->employeeLevelId => array(
		'view',
		'id' => $model->employeeLevelId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List EmployeeLevel',
		'url' => array(
			'index')),
	array(
		'label' => 'Create EmployeeLevel',
		'url' => array(
			'create')),
	array(
		'label' => 'View EmployeeLevel',
		'url' => array(
			'view',
			'id' => $model->employeeLevelId)),
	array(
		'label' => 'Manage EmployeeLevel',
		'url' => array(
			'admin')),
);
?>

<h1>Update EmployeeLevel <?php echo $model->employeeLevelId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>