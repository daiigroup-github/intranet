<?php
$this->breadcrumbs = array(
	'Stock Details'=>array(
		'index'),
	$model->stockDetailId,
);

$this->menu = array(
	array(
		'label'=>'List StockDetail',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create StockDetail',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update StockDetail',
		'url'=>array(
			'update',
			'id'=>$model->stockDetailId)),
	array(
		'label'=>'Delete StockDetail',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->stockDetailId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage StockDetail',
		'url'=>array(
			'admin')),
);
?>

<h1>View StockDetail #<?php echo $model->stockDetailId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'stockDetailId',
		'stockDetailCode',
		'stockDetailName',
		'stockDetailUnit',
		'createDateTime',
		'active',
	),
));
?>
