<?php
/* @var $this TheaterShowtimeController */
/* @var $data TheaterShowtime */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterShowtimeId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->theaterShowtimeId), array('view', 'id'=>$data->theaterShowtimeId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterId')); ?>:</b>
	<?php echo CHtml::encode($data->theaterId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterMovieId')); ?>:</b>
	<?php echo CHtml::encode($data->theaterMovieId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('showDate')); ?>:</b>
	<?php echo CHtml::encode($data->showDate); ?>
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