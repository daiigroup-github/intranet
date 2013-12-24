<?php
$this->breadcrumbs = array(
	'Workflows' => array(
		'index'),
	$model->workflowId => array(
		'view',
		'id' => $model->workflowId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List Workflow',
		'url' => array(
			'index')),
	array(
		'label' => 'Create Workflow',
		'url' => array(
			'create')),
	array(
		'label' => 'View Workflow',
		'url' => array(
			'view',
			'id' => $model->workflowId)),
	array(
		'label' => 'Manage Workflow',
		'url' => array(
			'admin')),
);
?>

<h1>Update Workflow <?php echo $model->workflowId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>