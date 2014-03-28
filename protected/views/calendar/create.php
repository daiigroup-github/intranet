<?php
/* @var $this CalendarController */
/* @var $model Calendar */

$this->breadcrumbs=array(
	'Calendars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Calendar', 'url'=>array('admin')),
	array('label'=>'Manage Calendar', 'url'=>array('index')),
);
?>

<div class="module">
	<div class="module-head">
		<h3>Create Calendar</h3>
	</div>
	<div class="module-body">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>