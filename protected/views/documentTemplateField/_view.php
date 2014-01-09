<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentTemplateFieldId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->documentTemplateFieldId), array(
		'view',
		'id'=>$data->documentTemplateFieldId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentTemplateFieldName')); ?>:</b>
	<?php echo CHtml::encode($data->documentTemplateFieldName); ?>
	<br />



	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />


</div>