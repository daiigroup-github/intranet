<?php
$this->breadcrumbs = array(
	'Document Control Datas',
);

$this->menu = array(
	array(
		'label' => 'Create DocumentControlData',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage DocumentControlData',
		'url' => array(
			'admin')),
);
?>

<h1>Document Control Datas</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
