<?php
$this->breadcrumbs = array(
	'Workflow States' => array(
		'index'),
	$model->workflowStateId => array(
		'view',
		'id' => $model->workflowStateId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List WorkflowState',
		'url' => array(
			'index')),
	array(
		'label' => 'Create WorkflowState',
		'url' => array(
			'create')),
	array(
		'label' => 'View WorkflowState',
		'url' => array(
			'view',
			'id' => $model->workflowStateId)),
	array(
		'label' => 'Manage WorkflowState',
		'url' => array(
			'admin')),
);
?>

<h1>Update WorkflowState <?php echo $model->workflowStateId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>