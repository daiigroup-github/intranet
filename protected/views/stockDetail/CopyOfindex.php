<?php
$this->breadcrumbs = array(
	'Stock Details',
);

$this->menu = array(
	array(
		'label'=>'Create StockDetail',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage StockDetail',
		'url'=>array(
			'admin')),
);
?>

<h1>Stock Details</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
