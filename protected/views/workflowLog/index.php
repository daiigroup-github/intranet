<?php
$this->breadcrumbs = array(
	'Workflow Logs',
);

$this->menu = array(
	array(
		'label'=>'Create WorkflowLog',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage WorkflowLog',
		'url'=>array(
			'admin')),
);
?>

<h1>Workflow Logs</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
