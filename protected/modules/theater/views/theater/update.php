<?php
/* @var $this TheaterController */
/* @var $model Theater */

$this->breadcrumbs=array(
	'Theaters'=>array('index'),
	$model->title=>array('view','id'=>$model->theaterId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Theater', 'url'=>array('admin')),
	array('label'=>'Create Theater', 'url'=>array('create')),
	array('label'=>'View Theater', 'url'=>array('view', 'id'=>$model->theaterId)),
	array('label'=>'Manage Theater', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update Theater <?php echo $model->theaterId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>