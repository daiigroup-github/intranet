<?php
$this->breadcrumbs = array(
	'Workflow Statuses',
);

$this->menu = array(
	array(
		'label' => 'Create WorkflowStatus',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage WorkflowStatus',
		'url' => array(
			'admin')),
);
?>

<h1>Workflow Statuses</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
