<?php
/* @var $this TheaterMovieController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Theater Movies',
);

$this->menu=array(
	array('label'=>'Create TheaterMovie', 'url'=>array('create')),
	array('label'=>'Manage TheaterMovie', 'url'=>array('index')),
);
?>

<h1>Theater Movies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
