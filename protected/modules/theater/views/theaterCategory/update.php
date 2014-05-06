<?php
/* @var $this TheaterCategoryController */
/* @var $model TheaterCategory */

$this->breadcrumbs=array(
	'Theater Categories'=>array('index'),
	$model->title=>array('view','id'=>$model->theaterCategoryId),
	'Update',
);

$this->menu=array(
	array('label'=>'List TheaterCategory', 'url'=>array('admin')),
	array('label'=>'Create TheaterCategory', 'url'=>array('create')),
	array('label'=>'View TheaterCategory', 'url'=>array('view', 'id'=>$model->theaterCategoryId)),
	array('label'=>'Manage TheaterCategory', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update TheaterCategory <?php echo $model->theaterCategoryId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>