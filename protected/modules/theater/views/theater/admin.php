<?php
/* @var $this TheaterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Theaters',
);

$this->menu=array(
	array('label'=>'Create Theater', 'url'=>array('create')),
	array('label'=>'Manage Theater', 'url'=>array('index')),
);
?>

<h1>Theaters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
