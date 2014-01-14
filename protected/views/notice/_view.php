<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('noticeId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->noticeId), array(
		'view',
		'id' => $data->noticeId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noticeTypeId')); ?>:</b>
	<?php echo CHtml::encode($data->noticeTypeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	  <?php echo CHtml::encode($data->updateDateTime); ?>
	  <br />

	 */ ?>

</div>