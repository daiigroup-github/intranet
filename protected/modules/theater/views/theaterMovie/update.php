<?php
/* @var $this TheaterMovieController */
/* @var $model TheaterMovie */

$this->breadcrumbs=array(
	'Theater Movies'=>array('index'),
	$model->title=>array('view','id'=>$model->theaterMovieId),
	'Update',
);

$this->menu=array(
	array('label'=>'List TheaterMovie', 'url'=>array('admin')),
	array('label'=>'Create TheaterMovie', 'url'=>array('create')),
	array('label'=>'View TheaterMovie', 'url'=>array('view', 'id'=>$model->theaterMovieId)),
	array('label'=>'Manage TheaterMovie', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update TheaterMovie <?php echo $model->theaterMovieId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>