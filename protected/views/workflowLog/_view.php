<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowLogId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->workflowLogId), array(
		'view',
		'id' => $data->workflowLogId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentId')); ?>:</b>
	<?php echo CHtml::encode($data->documentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowStateId')); ?>:</b>
	<?php echo CHtml::encode($data->workflowStateId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />


</div>