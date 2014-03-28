<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeLevelId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->employeeLevelId), array(
		'view',
		'id' => $data->employeeLevelId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyId')); ?>:</b>
	<?php echo CHtml::encode($data->companyId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('divisionId')); ?>:</b>
	<?php echo CHtml::encode($data->divisionId); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('isManager')); ?>:</b>
	  <?php echo CHtml::encode($data->isManager); ?>
	  <br />

	 */ ?>

</div>