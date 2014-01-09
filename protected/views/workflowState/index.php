<?php
$this->breadcrumbs = array(
	'Workflow States',
);

$this->menu = array(
	array(
		'label'=>'Create WorkflowState',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage WorkflowState',
		'url'=>array(
			'admin')),
);
?>

<h1>Workflow States</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
