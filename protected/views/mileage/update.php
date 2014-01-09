<?php
$this->breadcrumbs = array(
	'Mileages'=>array(
		'index'),
	$model->mileageId=>array(
		'view',
		'id'=>$model->mileageId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List Mileage',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Mileage',
		'url'=>array(
			'create')),
	array(
		'label'=>'View Mileage',
		'url'=>array(
			'view',
			'id'=>$model->mileageId)),
	array(
		'label'=>'Manage Mileage',
		'url'=>array(
			'admin')),
);
?>

<h1>Update Mileage <?php echo $model->mileageId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>