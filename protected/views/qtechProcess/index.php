<?php
$this->breadcrumbs = array(
	'Qtech Processes',
);

$this->menu = array(
	array(
		'label' => 'Create QtechProcess',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage QtechProcess',
		'url' => array(
			'admin')),
);
?>

<h1>Qtech Processes</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
