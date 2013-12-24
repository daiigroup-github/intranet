<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->customerId), array(
		'view',
		'id' => $data->customerId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerType')); ?>:</b>
	<?php echo CHtml::encode($data->customerType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerFnTh')); ?>:</b>
	<?php echo CHtml::encode($data->customerFnTh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerLnTh')); ?>:</b>
	<?php echo CHtml::encode($data->customerLnTh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerCompany')); ?>:</b>
	<?php echo CHtml::encode($data->customerCompany); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	  <?php echo CHtml::encode($data->password); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('companyValue')); ?>:</b>
	  <?php echo CHtml::encode($data->companyValue); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('saleId')); ?>:</b>
	  <?php echo CHtml::encode($data->saleId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('engineerId')); ?>:</b>
	  <?php echo CHtml::encode($data->engineerId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('branchId')); ?>:</b>
	  <?php echo CHtml::encode($data->branchId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('branchValue')); ?>:</b>
	  <?php echo CHtml::encode($data->branchValue); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	  <?php echo CHtml::encode($data->address); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	  <?php echo CHtml::encode($data->city); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:</b>
	  <?php echo CHtml::encode($data->province); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('zipcode')); ?>:</b>
	  <?php echo CHtml::encode($data->zipcode); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	  <?php echo CHtml::encode($data->phone); ?>
	  <br />

	 */ ?>

</div>