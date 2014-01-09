<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowStateId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->workflowStateId), array(
		'view',
		'id'=>$data->workflowStateId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowStateName')); ?>:</b>
	<?php echo CHtml::encode($data->workflowStateName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('currentState')); ?>:</b>
	<?php echo CHtml::encode($data->currentState); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nextState')); ?>:</b>
	<?php echo CHtml::encode($data->nextState); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowStatusId')); ?>:</b>
	<?php echo CHtml::encode($data->workflowStatusId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowGroupId')); ?>:</b>
	<?php echo CHtml::encode($data->workflowGroupId); ?>
	<br />


</div>