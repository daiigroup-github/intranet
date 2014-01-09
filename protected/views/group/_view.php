<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->groupId), array(
		'view',
		'id'=>$data->groupId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupName')); ?>:</b>
	<?php echo CHtml::encode($data->groupName); ?>
	<br />


</div>