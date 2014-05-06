<?php
/* @var $this TheaterMovieController */
/* @var $model TheaterMovie */

$this->breadcrumbs=array(
	'Theater Movies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TheaterMovie', 'url'=>array('admin')),
	array('label'=>'Manage TheaterMovie', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create TheaterMovie</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>