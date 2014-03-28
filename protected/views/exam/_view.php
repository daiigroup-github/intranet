<?php
/* @var $this ExamController */
/* @var $data ExamTitle */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('examId')); ?>:</b>
	<?php
	echo CHtml::link(CHtml::encode($data->examId), array(
		'view',
		'id' => $data->examId));
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->createDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('examTitle')); ?>:</b>
	<?php echo CHtml::encode($data->examTitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator')); ?>:</b>
	<?php echo CHtml::encode($data->creator); ?>
	<br />


</div>