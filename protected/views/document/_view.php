<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->documentId), array(
		'view',
		'id' => $data->documentId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentCode')); ?>:</b>
	<?php echo CHtml::encode($data->documentCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentTypeId')); ?>:</b>
	<?php echo CHtml::encode($data->documentTypeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />


</div>