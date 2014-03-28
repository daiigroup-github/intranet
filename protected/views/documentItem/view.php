<?php
$this->breadcrumbs = array(
	'Document Items' => array(
		'index'),
	$model->documentItemId,
);

$this->menu = array(
	array(
		'label' => 'List DocumentItem',
		'url' => array(
			'index')),
	array(
		'label' => 'Create DocumentItem',
		'url' => array(
			'create')),
	array(
		'label' => 'Update DocumentItem',
		'url' => array(
			'update',
			'id' => $model->documentItemId)),
	array(
		'label' => 'Delete DocumentItem',
		'url' => '#',
		'linkOptions' => array(
			'submit' => array(
				'delete',
				'id' => $model->documentItemId),
			'confirm' => 'Are you sure you want to delete this item?')),
	array(
		'label' => 'Manage DocumentItem',
		'url' => array(
			'admin')),
);
?>

<h1>View DocumentItem #<?php echo $model->documentItemId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'documentItemId',
		'documentId',
		'documentItemName',
		'description1',
		'description2',
		'description3',
	),
));
?>
