<?php
$this->breadcrumbs = array(
	'Customer Sales' => array(
		'index'),
	$model->id,
);

$this->menu = array(
	array(
		'label' => 'List CustomerSale',
		'url' => array(
			'index')),
	array(
		'label' => 'Create CustomerSale',
		'url' => array(
			'create')),
	array(
		'label' => 'Update CustomerSale',
		'url' => array(
			'update',
			'id' => $model->id)),
	array(
		'label' => 'Delete CustomerSale',
		'url' => '#',
		'linkOptions' => array(
			'submit' => array(
				'delete',
				'id' => $model->id),
			'confirm' => 'Are you sure you want to delete this item?')),
	array(
		'label' => 'Manage CustomerSale',
		'url' => array(
			'admin')),
);
?>

<h1>View CustomerSale #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'customerId',
		'saleId',
		'companyValue',
		'createDateTime',
	),
));
?>
