<?php
/* @var $this FitAndFastController */
/* @var $model FitAndFast */

$this->breadcrumbs=array(
	'Fit And Fasts'=>array('index'),
	$model->title=>array('view','id'=>$model->fitAndFastId),
	'Update',
);

$this->menu=array(
	array('label'=>'List FitAndFast', 'url'=>array('index')),
	array('label'=>'Create FitAndFast', 'url'=>array('create')),
	array('label'=>'View FitAndFast', 'url'=>array('view', 'id'=>$model->fitAndFastId)),
	array('label'=>'Manage FitAndFast', 'url'=>array('admin')),
);
?>

<h1>Update FitAndFast <?php echo $model->fitAndFastId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>