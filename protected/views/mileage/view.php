<?php
$this->breadcrumbs = array(
	'Mileages'=>array(
		'index'),
	$model->mileageId,
);

$this->menu = array(
	array(
		'label'=>'List Mileage',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Mileage',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update Mileage',
		'url'=>array(
			'update',
			'id'=>$model->mileageId)),
	array(
		'label'=>'Delete Mileage',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->mileageId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage Mileage',
		'url'=>array(
			'admin')),
);
?>

<h1>View Mileage #<?php echo $model->mileageId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mileageId',
		'status',
		'createDate',
		'createTime',
		'captureDateTime',
		'mileage',
		'mileageDiff',
		'mileageDetail',
		'mileageImage',
		'latitude',
		'longitude',
		'employeeId',
		'branchId',
		'projectId',
	),
));
?>
