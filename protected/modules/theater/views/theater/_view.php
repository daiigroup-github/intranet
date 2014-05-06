<?php
/* @var $this TheaterController */
/* @var $data Theater */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->theaterId), array('view', 'id'=>$data->theaterId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seats')); ?>:</b>
	<?php echo CHtml::encode($data->seats); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staffId')); ?>:</b>
	<?php echo CHtml::encode($data->staffId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startTime')); ?>:</b>
	<?php echo CHtml::encode($data->startTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endTime')); ?>:</b>
	<?php echo CHtml::encode($data->endTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	*/ ?>

</div>