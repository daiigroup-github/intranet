<?php
/* @var $this TheaterEmployeeMovieRequireController */
/* @var $model TheaterEmployeeMovieRequire */

$this->breadcrumbs=array(
	'Theater Employee Movie Requires'=>array('index'),
	$model->theaterEmployeeMovieRequireId=>array('view','id'=>$model->theaterEmployeeMovieRequireId),
	'Update',
);

$this->menu=array(
	array('label'=>'List TheaterEmployeeMovieRequire', 'url'=>array('admin')),
	array('label'=>'Create TheaterEmployeeMovieRequire', 'url'=>array('create')),
	array('label'=>'View TheaterEmployeeMovieRequire', 'url'=>array('view', 'id'=>$model->theaterEmployeeMovieRequireId)),
	array('label'=>'Manage TheaterEmployeeMovieRequire', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update TheaterEmployeeMovieRequire <?php echo $model->theaterEmployeeMovieRequireId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>