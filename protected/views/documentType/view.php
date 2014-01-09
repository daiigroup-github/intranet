<?php
$this->breadcrumbs = array(
	'Document Types'=>array(
		'index'),
	$model->documentTypeId,
);

$this->menu = array(
	array(
		'label'=>'List DocumentType',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create DocumentType',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update DocumentType',
		'url'=>array(
			'update',
			'id'=>$model->documentTypeId)),
	array(
		'label'=>'Delete DocumentType',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->documentTypeId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage DocumentType',
		'url'=>array(
			'admin')),
);
?>

<h1>View DocumentType #<?php echo $model->documentTypeId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'documentTypeId',
		'documentTypeName',
		'active',
		'workflowGroupId',
	),
));
?>
