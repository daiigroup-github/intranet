<?php
$this->breadcrumbs = array(
	'Workflow States'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List WorkflowState',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage WorkflowState',
		'url'=>array(
			'admin')),
);
?>

<h1>Create WorkflowState</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>