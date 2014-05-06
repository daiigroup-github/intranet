<?php
/* @var $this TheaterShowtimeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Theater Showtimes',
);

$this->menu=array(
	array('label'=>'Create TheaterShowtime', 'url'=>array('create')),
	array('label'=>'Manage TheaterShowtime', 'url'=>array('index')),
);
?>

<h1>Theater Showtimes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
