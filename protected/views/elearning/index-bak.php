<?php
/* @var $this ElearningController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Elearnings',
);

$this->menu=array(
	array('label'=>'Create Elearning', 'url'=>array('create')),
	array('label'=>'Manage Elearning', 'url'=>array('admin')),
);
?>

<h1>Elearnings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
