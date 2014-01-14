<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowStatusId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->workflowStatusId), array(
		'view',
		'id' => $data->workflowStatusId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowStatusName')); ?>:</b>
	<?php echo CHtml::encode($data->workflowStatusName); ?>
	<br />


</div>