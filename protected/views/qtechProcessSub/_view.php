<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('processSubId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->processSubId), array(
		'view',
		'id' => $data->processSubId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qtechProjectId')); ?>:</b>
	<?php echo CHtml::encode($data->qtechProjectId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qtechProcessId')); ?>:</b>
	<?php echo CHtml::encode($data->qtechProcessId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('processSubName')); ?>:</b>
	<?php echo CHtml::encode($data->processSubName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('processSubDetail')); ?>:</b>
	<?php echo CHtml::encode($data->processSubDetail); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('earningPrecent')); ?>:</b>
	  <?php echo CHtml::encode($data->earningPrecent); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('contractorCost')); ?>:</b>
	  <?php echo CHtml::encode($data->contractorCost); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	  <?php echo CHtml::encode($data->duration); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('paymentNo')); ?>:</b>
	  <?php echo CHtml::encode($data->paymentNo); ?>
	  <br />

	 */ ?>

</div>