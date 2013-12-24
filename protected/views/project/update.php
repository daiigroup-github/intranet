<?php
$this->breadcrumbs = array(
	'Projects' => array(
		'index'),
	$model->projectId => array(
		'view',
		'id' => $model->projectId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List Project',
		'url' => array(
			'index')),
	array(
		'label' => 'Create Project',
		'url' => array(
			'create')),
	array(
		'label' => 'View Project',
		'url' => array(
			'view',
			'id' => $model->projectId)),
	array(
		'label' => 'Manage Project',
		'url' => array(
			'admin')),
);
?>

<h1>Update Project <?php echo $model->projectId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>