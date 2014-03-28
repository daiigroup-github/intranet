<?php
$this->breadcrumbs = array(
	'Customer Sales' => array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label' => 'List CustomerSale',
		'url' => array(
			'index')),
	array(
		'label' => 'Manage CustomerSale',
		'url' => array(
			'admin')),
);
?>

<h1>Create CustomerSale</h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>