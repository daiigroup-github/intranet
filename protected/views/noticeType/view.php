<?php
$this->breadcrumbs = array(
	'Notice Types' => array(
		'index'),
	$model->noticeTypeId,
);

$this->menu = array(
	array(
		'label' => 'List NoticeType',
		'url' => array(
			'index')),
	array(
		'label' => 'Create NoticeType',
		'url' => array(
			'create')),
	array(
		'label' => 'Update NoticeType',
		'url' => array(
			'update',
			'id' => $model->noticeTypeId)),
	array(
		'label' => 'Delete NoticeType',
		'url' => '#',
		'linkOptions' => array(
			'submit' => array(
				'delete',
				'id' => $model->noticeTypeId),
			'confirm' => 'Are you sure you want to delete this item?')),
	array(
		'label' => 'Manage NoticeType',
		'url' => array(
			'admin')),
);
?>

<h1>View NoticeType #<?php echo $model->noticeTypeId; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'noticeTypeId',
		'noticeTypeName',
		array(
			'name' => 'createDateTime',
			'type' => 'raw',
			'htmlOptions' => array(
				'style' => 'text-align:center;width:17%;'),
			'value' => ($model->createDateTime) ? Controller::dateThai($model->createDateTime, 3) : "-",
		),
	),
));
?>
