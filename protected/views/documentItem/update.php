<?php
$this->breadcrumbs = array(
	'Document Items'=>array(
		'index'),
	$model->documentItemId=>array(
		'view',
		'id'=>$model->documentItemId),
	'Update',
);

$this->menu = array(
	array(
		'label'=>'List DocumentItem',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create DocumentItem',
		'url'=>array(
			'create')),
	array(
		'label'=>'View DocumentItem',
		'url'=>array(
			'view',
			'id'=>$model->documentItemId)),
	array(
		'label'=>'Manage DocumentItem',
		'url'=>array(
			'admin')),
);
?>

<h1>Update DocumentItem <?php echo $model->documentItemId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>