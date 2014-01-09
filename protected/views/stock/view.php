<?php
$this->breadcrumbs = array(
	'Stocks'=>array(
		'index'),
	$model->stockId,
);

$this->menu = array(
	array(
		'label'=>'List Stock',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Stock',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update Stock',
		'url'=>array(
			'update',
			'id'=>$model->stockId)),
	array(
		'label'=>'Delete Stock',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->stockId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage Stock',
		'url'=>array(
			'admin')),
);
?>

<h1>View Stock #<?php echo $model->stockId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'stockId',
		'stockDetailId',
		'stockQuantity',
		'companyId',
		'stockUnitPrice',
		array(
			'name'=>'createDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:17%;'),
			'value'=>($model->createDateTime) ? Controller::dateThai($model->createDateTime, 3) : "-",
		),
		array(
			'name'=>'updateDateTime',
			'type'=>'raw',
			'htmlOptions'=>array(
				'style'=>'text-align:center;width:17%;'),
			'value'=>($model->updateDateTime) ? Controller::dateThai($model->updateDateTime, 3) : "-",
		),
		'status',
	),
));
?>
