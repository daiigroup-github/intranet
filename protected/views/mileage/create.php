<?php
$this->breadcrumbs = array(
	'Mileages' => array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label' => 'List Mileage',
		'url' => array(
			'index')),
	array(
		'label' => 'Manage Mileage',
		'url' => array(
			'admin')),
);
?>

<h1>Create Mileage</h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>