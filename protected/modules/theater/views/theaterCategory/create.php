<?php
/* @var $this TheaterCategoryController */
/* @var $model TheaterCategory */

$this->breadcrumbs=array(
	'Theater Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TheaterCategory', 'url'=>array('admin')),
	array('label'=>'Manage TheaterCategory', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create TheaterCategory</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>