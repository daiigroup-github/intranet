<?php
$this->breadcrumbs = array(
	'Workflow Logs'=>array(
		'index'),
	$model->workflowLogId=>array(
		'view',
		'id'=>$model->workflowLogId),
	'Update',
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
		'label'=>'View WorkflowLog',
		'url'=>array(
			'view',
			'id'=>$model->workflowLogId)),
	array(
		'label'=>'Manage WorkflowLog',
		'url'=>array(
			'admin')),
);
?>

<h1>Update WorkflowLog <?php echo $model->workflowLogId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>