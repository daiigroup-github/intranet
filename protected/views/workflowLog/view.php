<?php
$this->breadcrumbs = array(
	'Workflow Logs'=>array(
		'index'),
	$model->workflowLogId,
);

$this->menu = array(
	array(
		'label'=>'List WorkflowLog',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create WorkflowLog',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update WorkflowLog',
		'url'=>array(
			'update',
			'id'=>$model->workflowLogId)),
	array(
		'label'=>'Delete WorkflowLog',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->workflowLogId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage WorkflowLog',
		'url'=>array(
			'admin')),
);
?>

<h1>View WorkflowLog #<?php echo $model->workflowLogId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'workflowLogId',
		'documentId',
		'workflowStateId',
		'employeeId',
		'createDateTime',
	),
));
?>
