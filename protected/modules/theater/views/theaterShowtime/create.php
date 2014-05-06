<?php
/* @var $this TheaterShowtimeController */
/* @var $model TheaterShowtime */

$this->breadcrumbs = array(
	'Theater Showtimes'=>array(
		'index'),
	'Create',
);

$this->menu = array(
	array(
		'label'=>'List TheaterShowtime',
		'url'=>array(
			'admin')),
	array(
		'label'=>'Manage TheaterShowtime',
		'url'=>array(
			'index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create TheaterShowtime</h3>
	</div>
	<div class="module-body">
<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'showtime'=>$showtime));
?>	</div>
</div>