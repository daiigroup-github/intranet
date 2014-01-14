<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('qtechProcessId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->qtechProcessId), array(
		'view',
		'id' => $data->qtechProcessId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qtechProjectId')); ?>:</b>
	<?php echo CHtml::encode($data->qtechProjectId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('processName')); ?>:</b>
	<?php echo CHtml::encode($data->processName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('processDetail')); ?>:</b>
	<?php echo CHtml::encode($data->processDetail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />


</div>