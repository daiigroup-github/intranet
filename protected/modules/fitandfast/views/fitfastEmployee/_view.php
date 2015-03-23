<?php
/* @var $this FitfastEmployeeController */
/* @var $data FitfastEmployee */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fitfastEmployeeId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fitfastEmployeeId), array('view', 'id'=>$data->fitfastEmployeeId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('halfS')); ?>:</b>
	<?php echo CHtml::encode($data->halfS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('S')); ?>:</b>
	<?php echo CHtml::encode($data->S); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('SS')); ?>:</b>
	<?php echo CHtml::encode($data->SS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('F')); ?>:</b>
	<?php echo CHtml::encode($data->F); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forYear')); ?>:</b>
	<?php echo CHtml::encode($data->forYear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percent')); ?>:</b>
	<?php echo CHtml::encode($data->percent); ?>
	<br />

	*/ ?>

</div>