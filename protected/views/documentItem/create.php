<?php
$this->breadcrumbs = array(
	'Document Items'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List DocumentItem',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage DocumentItem',
		'url'=>array(
			'admin')),
);
?>

<h1>Create DocumentItem</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model));
?>