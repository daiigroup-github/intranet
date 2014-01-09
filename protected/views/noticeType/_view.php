<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('noticeTypeId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->noticeTypeId), array(
		'view',
		'id'=>$data->noticeTypeId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noticeTypeName')); ?>:</b>
	<?php echo CHtml::encode($data->noticeTypeName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />


</div>