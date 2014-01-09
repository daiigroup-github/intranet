<?php
$this->breadcrumbs = array(
	'Employee Levels'=>array(
		'index'),
	$model->employeeLevelId,
);

$this->menu = array(
	array(
		'label'=>'List EmployeeLevel',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create EmployeeLevel',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update EmployeeLevel',
		'url'=>array(
			'update',
			'id'=>$model->employeeLevelId)),
	array(
		'label'=>'Delete EmployeeLevel',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->employeeLevelId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage EmployeeLevel',
		'url'=>array(
			'admin')),
);
?>

<h1>View EmployeeLevel #<?php echo $model->employeeLevelId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'employeeLevelId',
		'status',
		'level',
		'description',
		'code',
		'companyId',
		'divisionId',
		'isManager',
	),
));
?>
