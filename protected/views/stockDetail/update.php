<?php
$this->breadcrumbs = array(
	'Stock Details'=>array(
		'index'),
	$model->stockDetailId=>array(
		'view',
		'id'=>$model->stockDetailId),
	'Update',
);

$this->menu = array(
	//array('label'=>'List StockDetail', 'url'=>array('index')),
	array(
		'label'=>'Create StockDetail',
		'url'=>array(
			'create')),
	//array('label'=>'View StockDetail', 'url'=>array('view', 'id'=>$model->stockDetailId)),
	array(
		'label'=>'Manage StockDetail',
		'url'=>array(
			'admin')),
);
?>

<h1>Update StockDetail <?php echo $model->stockDetailId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>