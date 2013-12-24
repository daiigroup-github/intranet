<?php
$this->breadcrumbs = array(
	'Customers' => array(
		'index'),
	$model->customerId => array(
		'view',
		'id' => $model->customerId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List Customer',
		'url' => array(
			'index')),
	array(
		'label' => 'Create Customer',
		'url' => array(
			'create')),
	array(
		'label' => 'View Customer',
		'url' => array(
			'view',
			'id' => $model->customerId)),
	array(
		'label' => 'Manage Customer',
		'url' => array(
			'admin')),
);
?>

<h1>Update Customer <?php echo $model->customerId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model,
	'customerSale' => $customerSale,));
?>