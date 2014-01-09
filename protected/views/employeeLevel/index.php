<?php
$this->breadcrumbs = array(
	'Employee Levels',
);

$this->menu = array(
	array(
		'label'=>'Create EmployeeLevel',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage EmployeeLevel',
		'url'=>array(
			'admin')),
);
?>

<h1>Employee Levels</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
