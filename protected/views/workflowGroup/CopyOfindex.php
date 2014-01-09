<?php
$this->breadcrumbs = array(
	'Workflow Groups',
);

$this->menu = array(
	array(
		'label'=>'Create WorkflowGroup',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage WorkflowGroup',
		'url'=>array(
			'admin')),
);
?>

<h1>Workflow Groups</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
