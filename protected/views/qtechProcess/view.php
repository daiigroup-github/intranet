<?php
$this->breadcrumbs = array(
	'Qtech Processes'=>array(
		'index'),
	$model->qtechProcessId,
);

$this->menu = array(
	array(
		'label'=>'List QtechProcess',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create QtechProcess',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update QtechProcess',
		'url'=>array(
			'update',
			'id'=>$model->qtechProcessId)),
	array(
		'label'=>'Delete QtechProcess',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->qtechProcessId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage QtechProcess',
		'url'=>array(
			'admin')),
);
?>

<h1>View QtechProcess #<?php echo $model->qtechProcessId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'qtechProcessId',
		'status',
		'qtechProjectId',
		'processName',
		'processDetail',
		'duration',
	),
));
?>
