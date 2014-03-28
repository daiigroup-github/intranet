<?php
/* @var $this CalendarController */
/* @var $model Calendar */

$this->breadcrumbs=array(
	'Calendars'=>array('index'),
	$model->title=>array('view','id'=>$model->calendarId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Calendar', 'url'=>array('admin')),
	array('label'=>'Create Calendar', 'url'=>array('create')),
	array('label'=>'View Calendar', 'url'=>array('view', 'id'=>$model->calendarId)),
	array('label'=>'Manage Calendar', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Update Calendar <?php echo $model->calendarId; ?></h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>