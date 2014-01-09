<?php
$this->breadcrumbs = array(
	'Memos'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List Memo',
		'url'=>array(
			'index')),
	array(
		'label'=>'Manage Memo',
		'url'=>array(
			'admin')),
);
?>

<h1>Create Memo</h1>

<?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'employeeModel'=>$employeeModel));
?>