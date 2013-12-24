<?php
$this->breadcrumbs = array(
	'Document Control Datas' => array(
		'index'),
	$model->documentControlDataId,
);

$this->menu = array(
	array(
		'label' => 'List DocumentControlData',
		'url' => array(
			'index')),
	array(
		'label' => 'Create DocumentControlData',
		'url' => array(
			'create')),
	array(
		'label' => 'Update DocumentControlData',
		'url' => array(
			'update',
			'id' => $model->documentControlDataId)),
	array(
		'label' => 'Delete DocumentControlData',
		'url' => '#',
		'linkOptions' => array(
			'submit' => array(
				'delete',
				'id' => $model->documentControlDataId),
			'confirm' => 'Are you sure you want to delete this item?')),
	array(
		'label' => 'Manage DocumentControlData',
		'url' => array(
			'admin')),
);
?>

<h1>View DocumentControlData #<?php echo $model->documentControlDataId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'documentControlDataId',
		'documentControlDataName',
		'dataModel',
		'dataMethod',
		'fieldId',
		'fieldValue',
	),
));
?>
