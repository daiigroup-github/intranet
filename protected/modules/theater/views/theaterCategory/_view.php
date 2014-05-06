<?php
/* @var $this TheaterCategoryController */
/* @var $data TheaterCategory */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterCategoryId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->theaterCategoryId), array('view', 'id'=>$data->theaterCategoryId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
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


</div>