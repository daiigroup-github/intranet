<?php
$this->breadcrumbs = array(
	'Workflow Logs'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List WorkflowLog',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage WorkflowLog',
		'url'=>array(
			'admin')),
);
?>

<h1>Create WorkflowLog</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>