<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('memoId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->memoId), array(
		'view',
		'id'=>$data->memoId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail')); ?>:</b>
	<?php echo CHtml::encode($data->detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createBy')); ?>:</b>
	<?php echo CHtml::encode($data->createBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />


</div>