<?php
$this->breadcrumbs = array(
	'Document Template Fields'=>array(
		'index'),
	$model->documentTemplateFieldId,
);

$this->menu = array(
	array(
		'label'=>'List DocumentTemplateField',
		'url'=>array(
			'index')),
	array(
		'label'=>'Create DocumentTemplateField',
		'url'=>array(
			'create')),
	array(
		'label'=>'Update DocumentTemplateField',
		'url'=>array(
			'update',
			'id'=>$model->documentTemplateFieldId)),
	array(
		'label'=>'Delete DocumentTemplateField',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id'=>$model->documentTemplateFieldId),
			'confirm'=>'Are you sure you want to delete this item?')),
	array(
		'label'=>'Manage DocumentTemplateField',
		'url'=>array(
			'admin')),
);
?>

<h1>View DocumentTemplateField #<?php echo $model->documentTemplateFieldId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'documentTemplateFieldId',
		'documentTemplateFieldName',
		//'documentTemplateFieldType',
		'status',
		'createDateTime',
	),
));
?>
