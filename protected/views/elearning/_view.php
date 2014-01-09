<?php
/* @var $this ElearningController */
/* @var $data Elearning */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('elearningCategoryId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->elearningCategoryId), array(
		'view',
		'id'=>$data->elearningCategoryId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parentId')); ?>:</b>
	<?php echo CHtml::encode($data->parentId); ?>
	<br />


</div>