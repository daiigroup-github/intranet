<?php
$this->breadcrumbs = array(
	'Customer Sales'=>array(
		'index'),
	$model->id=>array(
		'view',
		'id'=>$model->id),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List CustomerSale',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create CustomerSale',
		'url'=>array(
			'create')),
	array(
		'label'=>'View CustomerSale',
		'url'=>array(
			'view',
			'id'=>$model->id)),
	array(
		'label'=>'Manage CustomerSale',
		'url'=>array(
			'admin')),
);
?>

<h1>Update CustomerSale <?php echo $model->id; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>