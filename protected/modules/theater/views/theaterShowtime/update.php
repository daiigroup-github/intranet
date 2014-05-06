<?php
/* @var $this TheaterShowtimeController */
/* @var $model TheaterShowtime */

$this->breadcrumbs=array(
	'Theater Showtimes'=>array('index'),
	$model->theaterShowtimeId=>array('view','id'=>$model->theaterShowtimeId),
	'Update',
);

$this->menu=array(
	array('label'=>'List TheaterShowtime', 'url'=>array('admin')),
	array('label'=>'Create TheaterShowtime', 'url'=>array('create')),
	array('label'=>'View TheaterShowtime', 'url'=>array('view', 'id'=>$model->theaterShowtimeId)),
	array('label'=>'Manage TheaterShowtime', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update TheaterShowtime <?php echo $model->theaterShowtimeId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>