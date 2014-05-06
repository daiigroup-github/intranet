<?php
/* @var $this TheaterCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Theater Categories',
);

$this->menu=array(
	array('label'=>'Create TheaterCategory', 'url'=>array('create')),
	array('label'=>'Manage TheaterCategory', 'url'=>array('index')),
);
?>

<h1>Theater Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
