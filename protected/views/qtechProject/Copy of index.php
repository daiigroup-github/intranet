<?php
$this->breadcrumbs = array(
	'Qtech Projects',
);

$this->menu = array(
	array(
		'label'=>'Create QtechProject',
		'url'=>array(
			'create')),
	array(
		'label'=>'Manage QtechProject',
		'url'=>array(
			'admin')),
);
?>

<h1>Qtech Projects</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
?>
