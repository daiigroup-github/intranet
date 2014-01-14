<?php
$this->breadcrumbs = array(
	'Qtech Process Subs' => array(
		'index'),
	$model->processSubId => array(
		'view',
		'id' => $model->processSubId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List QtechProcessSub',
		'url' => array(
			'index')),
	array(
		'label' => 'Create QtechProcessSub',
		'url' => array(
			'create')),
	array(
		'label' => 'View QtechProcessSub',
		'url' => array(
			'view',
			'id' => $model->processSubId)),
	array(
		'label' => 'Manage QtechProcessSub',
		'url' => array(
			'admin')),
);
?>

<h1>Update QtechProcessSub <?php echo $model->processSubId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>