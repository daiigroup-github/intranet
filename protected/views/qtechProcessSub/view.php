<?php
$this->breadcrumbs = array(
	'Qtech Process Subs' => array(
		'index'),
	$model->processSubId,
);

$this->menu = array(
	array(
		'label' => 'List QtechProcessSub',
		'url' => array(
			'index')),
	array(
		'label' => 'Create QtechProcessSub',
		'url' => array(
			'create')),
	array(
		'label' => 'Update QtechProcessSub',
		'url' => array(
			'update',
			'id' => $model->processSubId)),
	array(
		'label' => 'Delete QtechProcessSub',
		'url' => '#',
		'linkOptions' => array(
			'submit' => array(
				'delete',
				'id' => $model->processSubId),
			'confirm' => 'Are you sure you want to delete this item?')),
	array(
		'label' => 'Manage QtechProcessSub',
		'url' => array(
			'admin')),
);
?>

<h1>View QtechProcessSub #<?php echo $model->processSubId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'processSubId',
		'status',
		'qtechProjectId',
		'qtechProcessId',
		'employeeId',
		'processSubName',
		'processSubDetail',
		'earningPrecent',
		'contractorCost',
		'duration',
		'paymentNo',
	),
));
?>
