<?php
$this->breadcrumbs = array(
	'Documents'=>array(
		'index'),
	$model->documentId=>array(
		'view',
		'id'=>$model->documentId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List Document',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create Document',
		'url'=>array(
			'create')),
	array(
		'label'=>'View Document',
		'url'=>array(
			'view',
			'id'=>$model->documentId)),
	array(
		'label'=>'Manage Document',
		'url'=>array(
			'admin')),
);
?>

<h1>Update Document <?php echo $model->documentId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>