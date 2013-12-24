<?php
$this->breadcrumbs = array(
	'Document Control Types',
);

$this->menu = array(
	array(
		'label' => 'Create DocumentControlType',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage DocumentControlType',
		'url' => array(
			'admin')),
);
?>

<h1>Document Control Types</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
