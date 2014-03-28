<?php
/* @var $this CalendarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Calendars',
);

$this->menu=array(
	array('label'=>'Create Calendar', 'url'=>array('create')),
	array('label'=>'Manage Calendar', 'url'=>array('index')),
);
?>

<h1>Calendars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
