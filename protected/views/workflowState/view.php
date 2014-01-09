<?php
$this->breadcrumbs = array(
	'Workflow States'=>array(
		'index'),
	$model->workflowStateId,
);

$this->menu = array(
	array(
		'label'=>'List WorkflowState',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create WorkflowState',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update WorkflowState',
		'url'=>array(
			'update',
			'id'=>$model->workflowStateId)),
	array(
		'label'=>'Delete WorkflowState',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->workflowStateId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage WorkflowState',
		'url'=>array(
			'admin')),
);
?>

<h1>View WorkflowState #<?php echo $model->workflowStateId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'workflowStateId',
		'workflowStateName',
		'currentState',
		'nextState',
		'workflowStatusId',
		'workflowGroupId',
	),
));
?>
