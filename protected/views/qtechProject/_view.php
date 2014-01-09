<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('qtechProjectId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->qtechProjectId), array(
		'view',
		'id'=>$data->qtechProjectId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createTime')); ?>:</b>
	<?php echo CHtml::encode($data->createTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productCatId')); ?>:</b>
	<?php echo CHtml::encode($data->productCatId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productValue')); ?>:</b>
	<?php echo CHtml::encode($data->productValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectName')); ?>:</b>
	<?php echo CHtml::encode($data->projectName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectDetail')); ?>:</b>
	<?php echo CHtml::encode($data->projectDetail); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('projectPrice')); ?>:</b>
	  <?php echo CHtml::encode($data->projectPrice); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('projectImage')); ?>:</b>
	  <?php echo CHtml::encode($data->projectImage); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('projectAddress')); ?>:</b>
	  <?php echo CHtml::encode($data->projectAddress); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	  <?php echo CHtml::encode($data->customerId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	  <?php echo CHtml::encode($data->employeeId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	  <?php echo CHtml::encode($data->startDate); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	  <?php echo CHtml::encode($data->endDate); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('latitude')); ?>:</b>
	  <?php echo CHtml::encode($data->latitude); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('longitude')); ?>:</b>
	  <?php echo CHtml::encode($data->longitude); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('branchValue')); ?>:</b>
	  <?php echo CHtml::encode($data->branchValue); ?>
	  <br />

	 */ ?>

</div>