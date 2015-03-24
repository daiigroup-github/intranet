<?php
/* @var $this FitfastEmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fitfast Employees',
);

$this->menu=array(
	array('label'=>'Create FitfastEmployee', 'url'=>array('create')),
	array('label'=>'Manage FitfastEmployee', 'url'=>array('admin')),
);
?>

<h1>Fitfast Employees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
