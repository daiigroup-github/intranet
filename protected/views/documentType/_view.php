<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentTypeId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->documentTypeId), array(
		'view',
		'id'=>$data->documentTypeId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentTypeName')); ?>:</b>
	<?php echo CHtml::encode($data->documentTypeName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workflowGroupId')); ?>:</b>
	<?php echo CHtml::encode($data->workflowGroupId); ?>
	<br />


</div>