<?php
/* @var $this ManageController */
/* @var $data Fitfast */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fitfastId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fitfastId), array('view', 'id'=>$data->fitfastId)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('fitfastEmployeeId')); ?>:</b>
	<?php echo CHtml::encode($data->fitfastEmployeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('halfS')); ?>:</b>
	<?php echo CHtml::encode($data->halfS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('S')); ?>:</b>
	<?php echo CHtml::encode($data->S); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SS')); ?>:</b>
	<?php echo CHtml::encode($data->SS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('F')); ?>:</b>
	<?php echo CHtml::encode($data->F); ?>
	<br />

	*/ ?>

</div>