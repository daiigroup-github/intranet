<?php
/* @var $this TheaterEmployeeMovieRequireController */
/* @var $data TheaterEmployeeMovieRequire */
?>

<div class="alert alert-info">

	<b><?php echo CHtml::encode($data->getAttributeLabel('theaterEmployeeMovieRequireId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->theaterEmployeeMovieRequireId), array('view', 'id'=>$data->theaterEmployeeMovieRequireId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employeeId')); ?>:</b>
	<?php echo CHtml::encode($data->employeeId); ?>
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