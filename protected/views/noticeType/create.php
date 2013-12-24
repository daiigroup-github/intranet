<?php
$this->breadcrumbs = array(
	'Notice Types' => array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label' => 'List NoticeType',
		'url' => array(
			'index')),
	array(
		'label' => 'Manage NoticeType',
		'url' => array(
			'admin')),
);
?>

<h1>Create NoticeType</h1>

<?php
echo $this->renderPartial('_form', array(
	'model' => $model));
?>