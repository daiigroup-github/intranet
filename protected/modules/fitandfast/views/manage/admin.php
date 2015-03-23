<?php
/* @var $this ManageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fitfasts',
);

$this->menu=array(
	array('label'=>'Create Fitfast', 'url'=>array('create')),
	array('label'=>'Manage Fitfast', 'url'=>array('admin')),
);
?>

<h1>Fitfasts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
