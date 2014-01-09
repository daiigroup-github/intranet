<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentItemId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->documentItemId), array(
		'view',
		'id'=>$data->documentItemId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentId')); ?>:</b>
	<?php echo CHtml::encode($data->documentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentItemName')); ?>:</b>
	<?php echo CHtml::encode($data->documentItemName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description1')); ?>:</b>
	<?php echo CHtml::encode($data->description1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description2')); ?>:</b>
	<?php echo CHtml::encode($data->description2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description3')); ?>:</b>
	<?php echo CHtml::encode($data->description3); ?>
	<br />


</div>