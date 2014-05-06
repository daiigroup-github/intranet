<?php
/* @var $this TheaterMovieController */
/* @var $data TheaterMovie */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterMovieId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->theaterMovieId), array('view', 'id'=>$data->theaterMovieId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterCategoryId')); ?>:</b>
	<?php echo CHtml::encode($data->theaterCategoryId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('length')); ?>:</b>
	<?php echo CHtml::encode($data->length); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('screenshotImage')); ?>:</b>
	<?php echo CHtml::encode($data->screenshotImage); ?>
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

	*/ ?>

</div>