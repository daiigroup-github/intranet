<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentControlTypeId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->documentControlTypeId), array(
		'view',
		'id' => $data->documentControlTypeId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentControlTypeName')); ?>:</b>
	<?php echo CHtml::encode($data->documentControlTypeName); ?>
	<br />


</div>