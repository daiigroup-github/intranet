<?php
$this->breadcrumbs = array(
	'Notices' => array(
		'index'),
	$model->title => array(
		'view',
		'id' => $model->noticeId),
	'Update',
);

$this->menu = array(
	array(
		'label' => 'List Notice',
		'url' => array(
			'index')),
	array(
		'label' => 'Create Notice',
		'url' => array(
			'create')),
	array(
		'label' => 'View Notice',
		'url' => array(
			'view',
			'id' => $model->noticeId)),
	array(
		'label' => 'Manage Notice',
		'url' => array(
			'admin')),
);
?>

<h1>Update Notice <?php echo $model->noticeId; ?></h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>