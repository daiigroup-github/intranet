<?php
/* @var $this ConstructionProjectController */
/* @var $data ConstructionProject */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->projectId), array(
		'view',
		'id'=>$data->projectId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productCatId')); ?>:</b>
	<?php echo CHtml::encode($data->productCatId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productValue')); ?>:</b>
	<?php echo CHtml::encode($data->productValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail')); ?>:</b>
	<?php echo CHtml::encode($data->detail); ?>
	<br />

	<?php /*
	  <b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	  <?php echo CHtml::encode($data->price); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('imageUrl')); ?>:</b>
	  <?php echo CHtml::encode($data->imageUrl); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	  <?php echo CHtml::encode($data->address); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('customerId')); ?>:</b>
	  <?php echo CHtml::encode($data->customerId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('engineerId')); ?>:</b>
	  <?php echo CHtml::encode($data->engineerId); ?>
	  <br />

	  <b><?php echo CHtml::encode($data->getAttributeLabel('saleId')); ?>:</b>
	  <?php echo CHtml::encode($data->saleId); ?>
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