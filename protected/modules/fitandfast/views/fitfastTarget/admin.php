<?php
/* @var $this FitfastTargetController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fitfast Targets',
);

$this->menu=array(
	array('label'=>'Create FitfastTarget', 'url'=>array('create')),
	array('label'=>'Manage FitfastTarget', 'url'=>array('admin')),
);
?>

<h1>Fitfast Targets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
