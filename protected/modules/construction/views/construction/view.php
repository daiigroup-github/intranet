<?php
/* @var $this ConstructionProjectController */
/* @var $model ConstructionProject */

$this->breadcrumbs = array(
	'Construction Projects'=>array(
		'index'),
	$model->name,
);

$this->menu = array(
	array(
		'label'=>'List ConstructionProject',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create ConstructionProject',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update ConstructionProject',
		'url'=>array(
			'update',
			'id'=>$model->projectId)),
	array(
		'label'=>'Delete ConstructionProject',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->projectId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage ConstructionProject',
		'url'=>array(
			'admin')),
);
?>

<h1>View ConstructionProject #<?php echo $model->projectId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'projectId',
		'status',
		'createDateTime',
		'productCatId',
		'productValue',
		'name',
		'detail',
		'price',
		'imageUrl',
		'address',
		'customerId',
		'engineerId',
		'saleId',
		'startDate',
		'endDate',
		'latitude',
		'longitude',
		'branchValue',
	),
));
?>
