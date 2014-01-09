<?php
$this->breadcrumbs = array(
	'Qtech Projects'=>array(
		'/qtechProject'),
	$model->project->customer->customerName . ' : ' . $model->project->projectName=>array(
		'/qtechProject/' . $model->qtechProjectId),
	$model->process->processName,
);

$this->menu = array(
	array(
		'label'=>'List QtechProcessSub',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage QtechProcessSub',
		'url'=>array(
			'admin')),
);
?>

<h1>Create QtechProcessSub</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>