<?php
$this->breadcrumbs = array(
	'Stock Details' => array(
		'index'),
	'Create',
);

$this->menu = array(
	//array('label'=>'List StockDetail', 'url'=>array('index')),
	array(
		'label' => 'Manage StockDetail',
		'url' => array(
			'admin')),
);
?>

<h1>Create Stock Item</h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>