<?php
$this->breadcrumbs = array(
	'Document Control Types' => array(
		'index'),
	$model->documentControlTypeId,
);

$this->menu = array(
	array(
		'label' => 'List DocumentControlType',
		'url' => array(
			'index')),
	array(
		'label' => 'Create DocumentControlType',
		'url' => array(
			'create')),
	array(
		'label' => 'Update DocumentControlType',
		'url' => array(
			'update',
			'id' => $model->documentControlTypeId)),
	array(
		'label' => 'Delete DocumentControlType',
		'url' => '#',
		'linkOptions' => array(
			'submit' => array(
				'delete',
				'id' => $model->documentControlTypeId),
			'confirm' => 'Are you sure you want to delete this item?')),
	array(
		'label' => 'Manage DocumentControlType',
		'url' => array(
			'admin')),
);
?>

<h1>View DocumentControlType #<?php echo $model->documentControlTypeId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'documentControlTypeId',
		'documentControlTypeName',
	),
));
?>
