<?php
/* @var $this TheaterController */
/* @var $model Theater */

$this->breadcrumbs=array(
	'Theaters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Theater', 'url'=>array('admin')),
	array('label'=>'Manage Theater', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create Theater</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>