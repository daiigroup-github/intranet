<?php
/* @var $this ConstructionProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
	'Construction Projects',
);

$this->menu = array(
	array(
		'label' => 'Create ConstructionProject',
		'url' => array(
			'create')),
	array(
		'label' => 'Manage ConstructionProject',
		'url' => array(
			'admin')),
);
?>

<h1>Construction Projects</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
?>
