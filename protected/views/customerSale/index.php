<?php
$this->breadcrumbs = array(
	'Customer Sales',
);

$this->menu = array(
	array(
		'label' => 'Create CustomerSale',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage CustomerSale',
		'url' => array(
			'admin')),
);
?>

<h1>Customer Sales</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
