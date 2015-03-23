<?php
/* @var $this FitfastTargetController */
/* @var $model FitfastTarget */

$this->breadcrumbs=array(
	'Fitfast Targets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FitfastTarget', 'url'=>array('index')),
	array('label'=>'Manage FitfastTarget', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">Create FitfastTarget</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>