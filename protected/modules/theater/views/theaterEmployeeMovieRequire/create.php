<?php
/* @var $this TheaterEmployeeMovieRequireController */
/* @var $model TheaterEmployeeMovieRequire */

$this->breadcrumbs=array(
	'Theater Employee Movie Requires'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TheaterEmployeeMovieRequire', 'url'=>array('admin')),
	array('label'=>'Manage TheaterEmployeeMovieRequire', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create TheaterEmployeeMovieRequire</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>