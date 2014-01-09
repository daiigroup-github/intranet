<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->workflowId), array(
		'view',
		'id'=>$data->workflowId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowName')); ?>:</b>
	<?php echo CHtml::encode($data->workflowName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeGroupId); ?>
	<br />


</div>