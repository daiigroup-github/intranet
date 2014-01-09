<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentControlDataId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->documentControlDataId), array(
		'view',
		'id'=>$data->documentControlDataId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentControlDataName')); ?>:</b>
	<?php echo CHtml::encode($data->documentControlDataName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataModel')); ?>:</b>
	<?php echo CHtml::encode($data->dataModel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dataMethod')); ?>:</b>
	<?php echo CHtml::encode($data->dataMethod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fieldId')); ?>:</b>
	<?php echo CHtml::encode($data->dataMethod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fieldValue')); ?>:</b>
	<?php echo CHtml::encode($data->dataMethod); ?>
	<br />


</div>