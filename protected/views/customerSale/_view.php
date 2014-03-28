<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->id), array(
		'view',
		'id' => $data->id));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	<?php echo CHtml::encode($data->customerId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saleId')); ?>:</b>
	<?php echo CHtml::encode($data->saleId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyValue')); ?>:</b>
	<?php echo CHtml::encode($data->companyValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />


</div>