<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->id), array(
		'view',
		'id' => $data->id));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createTime')); ?>:</b>
	<?php echo CHtml::encode($data->createTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modTime')); ?>:</b>
	<?php echo CHtml::encode($data->modTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	  <?php echo CHtml::encode($data->email); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
	  <?php echo CHtml::encode($data->prefix); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('prefixOther')); ?>:</b>
	  <?php echo CHtml::encode($data->prefixOther); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('fnTh')); ?>:</b>
	  <?php echo CHtml::encode($data->fnTh); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('lnTh')); ?>:</b>
	  <?php echo CHtml::encode($data->lnTh); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('fnEn')); ?>:</b>
	  <?php echo CHtml::encode($data->fnEn); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('lnEn')); ?>:</b>
	  <?php echo CHtml::encode($data->lnEn); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	  <?php echo CHtml::encode($data->gender); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('positionLevel')); ?>:</b>
	  <?php echo CHtml::encode($data->positionLevel); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	  <?php echo CHtml::encode($data->position); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('companyId')); ?>:</b>
	  <?php echo CHtml::encode($data->companyId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('companyValue')); ?>:</b>
	  <?php echo CHtml::encode($data->companyValue); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('branchId')); ?>:</b>
	  <?php echo CHtml::encode($data->branchId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('branchValue')); ?>:</b>
	  <?php echo CHtml::encode($data->branchValue); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('divisionId')); ?>:</b>
	  <?php echo CHtml::encode($data->divisionId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('managerId')); ?>:</b>
	  <?php echo CHtml::encode($data->managerId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('startDate')); ?>:</b>
	  <?php echo CHtml::encode($data->startDate); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('proDate')); ?>:</b>
	  <?php echo CHtml::encode($data->proDate); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('transferDate')); ?>:</b>
	  <?php echo CHtml::encode($data->transferDate); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('endDate')); ?>:</b>
	  <?php echo CHtml::encode($data->endDate); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('birthDate')); ?>:</b>
	  <?php echo CHtml::encode($data->birthDate); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('isSale')); ?>:</b>
	  <?php echo CHtml::encode($data->isSale); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('isEngineer')); ?>:</b>
	  <?php echo CHtml::encode($data->isEngineer); ?>
	  <br />

	 */ ?>

</div>