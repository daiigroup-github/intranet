<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockDetailId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->stockDetailId), array(
		'view',
		'id'=>$data->stockDetailId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockDetailCode')); ?>:</b>
	<?php echo CHtml::encode($data->stockDetailCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockDetailName')); ?>:</b>
	<?php echo CHtml::encode($data->stockDetailName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockDetailUnit')); ?>:</b>
	<?php echo CHtml::encode($data->stockDetailUnit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

</div>