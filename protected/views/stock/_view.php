<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->stockId), array(
		'view',
		'id' => $data->stockId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockDetailId')); ?>:</b>
	<?php echo CHtml::encode($data->stockDetailId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockQuantity')); ?>:</b>
	<?php echo CHtml::encode($data->stockQuantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyId')); ?>:</b>
	<?php echo CHtml::encode($data->companyId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stockUnitPrice')); ?>:</b>
	<?php echo CHtml::encode($data->stockUnitPrice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	  <?php echo CHtml::encode($data->active); ?>
	  <br />

	 */ ?>

</div>