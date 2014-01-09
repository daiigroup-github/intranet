<?php
$this->breadcrumbs = array(
	'Qtech Projects'=>array(
		'index'),
	$model->customer->customerName . ' : ' . $model->projectName=>array(
		'/qtechProject/' . $model->qtechProjectId),
	$processSubModel->process->processName,
);

$this->menu = array(
	array(
		'label'=>'Create QtechProject',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage QtechProject',
		'url'=>array(
			'admin')),
);
?>

<h1><?php echo $processSubModel->processSubName; ?></h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_qtechProcessSubImage',
));
?>
