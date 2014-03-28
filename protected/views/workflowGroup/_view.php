<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowGroupId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->workflowGroupId), array(
		'view',
		'id' => $data->workflowGroupId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowGroupName')); ?>:</b>
	<?php echo CHtml::encode($data->workflowGroupName); ?>
	<br />


</div>