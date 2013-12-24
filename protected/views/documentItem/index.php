<?php
$this->breadcrumbs = array(
	'Document Items',
);

$this->menu = array(
	array(
		'label' => 'Create DocumentItem',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage DocumentItem',
		'url' => array(
			'admin')),
);
?>

<h1>Document Items</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
